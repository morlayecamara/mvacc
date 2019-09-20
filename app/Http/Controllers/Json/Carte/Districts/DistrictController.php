<?php

namespace blog\Http\Controllers\Json\Carte\Districts;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Percent;  
use blog\Http\Controllers\Controller; 

class DistrictController extends Controller
{
  
    public function getData(Request $request)
    { 
       
    	  $province =  $request->input('province');
    	  $district =  $request->input('district'); 
    	  $percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully')  
                                  ->where('province', '=', $province)
                                  ->where('district', '=', $district)  
                                  ->whereBetween('age', [0, 23]) 
                                  ->orderBy('health_facility', 'asc')
                                  ->get(); 
    	 
		   
         $arry_facility = array();
         $facilitys = Percent::select('health_facility')
                ->where('province', '=', $province)
                ->where('district', '=', $district)
                ->whereBetween('age', [0, 23]) 
                ->groupBy('health_facility') 
                ->get(); 
        if (is_null($facilitys)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }
        foreach ($facilitys as $health_facility) {
       	  $res = $health_facility->health_facility;
       	  array_push($arry_facility, $res);
       	  ${$res.'fully'} = 0;
       	  ${$res.'all_12_23'} = 0;
        }
        if (is_null($percents)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }
       $current_faclity=null;
       $donnees = array();
       

       $allChildren_12_23 = 0;
       $health_facility_fully = 0; 
       foreach ($percents as $child) {
         $age = $child->age;
         if($age >= 12 and $age < 24)
         {
       		  $uuid = $child->uuid;
       	    $health_facility = $child->health_facility;  
            $result   = $child->fully;  
	        if($current_faclity!=$health_facility) 
	        {   
	            $current_faclity=$health_facility;  
	        }
	        if($current_faclity==$health_facility) 
	        {
	               ${$current_faclity.'all_12_23'} = ${$current_faclity.'all_12_23'} + 1;
		            if($result == 1)
			        {   
			            ${$current_faclity.'fully'} = ${$current_faclity.'fully'} + 1;   
				    }
	          } 
	       } 
     }

     foreach ($arry_facility as $arry_faci) { 
        if(${$arry_faci.'all_12_23'} != 0)
        {
          ${$arry_faci} = round((${$arry_faci.'fully'}*100)/ ${$arry_faci.'all_12_23'});
        }
        else
        {
          ${$arry_faci} = 0;
        }
     	  
          $donnees[] = [$arry_faci,${$arry_faci}];
     } 
       return $donnees;
    } 
}
