<?php

namespace blog\Http\Controllers\Json\Carte\Zone;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Percent;  
use blog\Http\Controllers\Controller; 

class ZoneController extends Controller
{
  
    public function getData(Request $request)
    { 
       
    	  $province =  $request->input('province');
    	  $district =  $request->input('district'); 
    	  $facility =  $request->input('facility');
    	  $zone =  $request->input('zone');
    	  $percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully','dist_faci_zone')  
                                  ->where('province', '=', $province)
                                  ->where('district', '=', $district) 
                                  ->where('health_facility', '=', $facility)
                                  ->where('zone', '=', $zone)   
                                  ->whereBetween('age', [0, 23]) 
                                  ->orderBy('location', 'asc') 
                                  ->get(); 
    	 
		   
         $arry_location = array();
         $locations = Percent::select('location')
                ->where('province', '=', $province)
                ->where('district', '=', $district)
                ->where('health_facility', '=', $facility)
                ->where('zone', '=', $zone)
                ->whereBetween('age', [0, 23]) 
                ->groupBy('location') 
                ->get(); 
        if (is_null($locations)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }
        foreach ($locations as $location) {
       	  $res = $location->location;
       	  array_push($arry_location, $res);
       	  ${$res.'fully'} = 0;
       	  ${$res.'all_12_23'} = 0;
        }
        if (is_null($percents)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }
       $current_location=null;
       $donnees = array();
       

       $allChildren_18_23 = 0;
       $location_fully = 0; 
       foreach ($percents as $child) {
         $age = $child->age;
         if($age >= 12 and $age < 24)
         {
       		$uuid = $child->uuid;
       	    $location = $child->location;  
            $result   = $child->fully;  
	        if($current_location!=$location) 
	        {   
	            $current_location=$location;  
	        }
	        if($current_location==$location) 
	        {
	        	if(!isset(${$current_location.'all_12_23'})) 
	        	{
	        		${$current_location.'all_12_23'} = 0;
	        	}
	        	if(!isset(${$current_location.'fully'}))
	        	{
	        		${$current_location.'fully'} = 0;
	        	}
	                ${$current_location.'all_12_23'} = ${$current_location.'all_12_23'} + 1;
		            if($result == 1)
			        {   
			            ${$current_location.'fully'} = ${$current_location.'fully'} + 1;   
				    }
	          } 
	       } 
     }

     foreach ($arry_location as $arry_l) { 
     	  if(${$arry_l.'all_12_23'} != 0)
     	  {
     	  	${$arry_l} = round((${$arry_l.'fully'}*100)/ ${$arry_l.'all_12_23'});
     	  }
     	  else
     	  {
     	  	${$arry_l} = 0;
     	  }
          $donnees[] = [$arry_l,${$arry_l}];
     } 
       return $donnees;
    } 
}
