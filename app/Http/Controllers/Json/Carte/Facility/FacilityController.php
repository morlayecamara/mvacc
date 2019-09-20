<?php

namespace blog\Http\Controllers\Json\Carte\Facility;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Percent;  
use blog\Http\Controllers\Controller; 

class FacilityController extends Controller
{
  
    public function getData(Request $request)
    { 
       
    	  $province =  $request->input('province');
    	  $district =  $request->input('district'); 
    	  $facility =  $request->input('facility');
    	  $percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully','dist_faci_zone')  
                                  ->where('province', '=', $province)
                                  ->where('district', '=', $district) 
                                  ->where('health_facility', '=', $facility)  
                                  ->whereBetween('age', [0, 23]) 
                                  ->orderBy('dist_faci_zone', 'asc')
                                  ->get(); 
    	 
		     
         $arry_zone = array();
         $zones = Percent::select('dist_faci_zone')
                ->where('province', '=', $province)
                ->where('district', '=', $district)
                ->where('health_facility', '=', $facility)
                ->whereBetween('age', [0, 23])
                ->groupBy('dist_faci_zone') 
                ->get(); 
        if (is_null($zones)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }
        foreach ($zones as $zone) {
       	  $res = $zone->dist_faci_zone;
       	  array_push($arry_zone, $res);
       	  ${$res.'fully'} = 0;
       	  ${$res.'all_12_23'} = 0;
        }
        if (is_null($percents)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }
       $current_zone=null;
       $donnees = array();
       

       $allChildren_12_23 = 0;
       $zone_fully = 0; 
       foreach ($percents as $child) {
         $age = $child->age;
         if($age >= 12 and $age < 24)
         {
       		$uuid = $child->uuid;
       	    $zone = $child->dist_faci_zone;  
            $result   = $child->fully;  
	        if($current_zone!=$zone) 
	        {   
	            $current_zone=$zone;  
	        }
	        if($current_zone==$zone) 
	        {
	               ${$current_zone.'all_12_23'} = ${$current_zone.'all_12_23'} + 1;
		            if($result == 1)
			        {   
			            ${$current_zone.'fully'} = ${$current_zone.'fully'} + 1;   
				    }
	          } 
	       } 
     }

     foreach ($arry_zone as $arry_z) { 
     	  if(${$arry_z.'all_12_23'} != 0)
     	  {
     	  	${$arry_z} = round((${$arry_z.'fully'}*100)/ ${$arry_z.'all_12_23'});
     	  }
     	  else
     	  {
     	  	${$arry_z} = 0;
     	  }
          $donnees[] = [$arry_z,${$arry_z}];
     } 
       return $donnees;
    } 
}
