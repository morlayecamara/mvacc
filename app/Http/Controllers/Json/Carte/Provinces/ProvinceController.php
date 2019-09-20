<?php

namespace blog\Http\Controllers\Json\Carte\Provinces;

use Illuminate\Http\Request;
use blog\Percent;  
use blog\Http\Requests;
use blog\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    public function getData(Request $request)
    {
         
       //$childrens = Children::all();
    	$province =  $request->input('province');
	  	$percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully') 
                                  ->where('province', '=', $province)  
                                  ->whereBetween('age', [0, 23]) 
                                  ->orderBy('district', 'asc')
                                  ->get(); 
        $arry_district = array();
        $districts = Percent::select('district')
                ->where('province', '=', $province)
                ->groupBy('district') 
                ->get(); 
        if (is_null($districts)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }
        foreach ($districts as $district) {
       	  $res = $district->district;
       	  array_push($arry_district, $res);
       	  ${$res.'fully'} = 0;
       	  ${$res.'all_12_23'} = 0;
        }
        if (is_null($percents)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }
       $current_district=null;
       $donnees = array();
       

       $allChildren_12_23 = 0;
       $district_fully = 0; 
       foreach ($percents as $child) {
            $age = $child->age; 
       	    $district = $child->district;  
            $result= $child->fully;
         

            if($age >= 12 and $age < 24)
	          { 
	                if($current_district!=$district) 
	                {   
	                   $current_district=$district;  
	                }
	                if($current_district==$district) 
	                {
	                	${$current_district.'all_12_23'} = ${$current_district.'all_12_23'} + 1;
		                if($result == 1)
			              {   
			                  ${$current_district.'fully'} = ${$current_district.'fully'} + 1;   
				            }
	                } 
	          } 
     }

     foreach ($arry_district as $arry_dist) { 
          if(${$arry_dist.'all_12_23'} != 0) 
          { 
         	  ${$arry_dist} = round((${$arry_dist.'fully'}*100)/ ${$arry_dist.'all_12_23'});
          }
          else
          {
            ${$arry_dist} = 0;
          }
          $donnees[] = [$arry_dist,${$arry_dist}];
     } 
       return $donnees;
    } 
}
