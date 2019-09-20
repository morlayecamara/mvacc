<?php

namespace blog\Http\Controllers\Json\Chart\Pie\Provinces;

use Illuminate\Http\Request;
use blog\Http\Controllers\Controller;
use blog\Percent; 
use blog\Http\Requests;
class ProvinceController extends Controller
{
    public function getData(Request $request)
	{
		 //$childrens = Percent::all();
	    $province =  $request->input('province');
        $district =  $request->input('district');
        $facility =  $request->input('facility');
        $zone     =  $request->input('zone');
        if($province != '' and $district == '' and $facility == '' and $zone == '')
        {
          $percents = Percent::select('uuid', 'age',
                                    'sex', 'province', 'district',
                                    'health_facility', 'location', 'chw_phone',
                                    'mother_phone', 'zone', 'bcg',
                                    'opv', 'dtp', 'pcv', 'rota', 'measles','fully') 
                                    ->where('province', '=', $province)   
                                    ->whereBetween('age', [0, 23]) 
                                    ->get(); 
        }
        elseif($province != '' and $district != '' and $facility == '' and $zone == '')
        {
          $percents = Percent::select('uuid', 'age',
                                    'sex', 'province', 'district',
                                    'health_facility', 'location', 'chw_phone',
                                    'mother_phone', 'zone', 'bcg',
                                    'opv', 'dtp', 'pcv', 'rota', 'measles','fully') 
                                    ->where('province', '=', $province) 
                                    ->where('district', '=', $district)   
                                    ->whereBetween('age', [0, 23]) 
                                    ->get();  
        }
        elseif($province != '' and $district != '' and $facility != '' and $zone == '')
        {
          $percents = Percent::select('uuid', 'age',
                                    'sex', 'province', 'district',
                                    'health_facility', 'location', 'chw_phone',
                                    'mother_phone', 'zone', 'bcg',
                                    'opv', 'dtp', 'pcv', 'rota', 'measles','fully') 
                                    ->where('province', '=', $province) 
                                    ->where('district', '=', $district)
                                    ->where('health_facility', '=', $facility)   
                                    ->whereBetween('age', [0, 23]) 
                                    ->get();  
        }
        elseif($province != '' and $district != '' and $facility != '' and $zone != '')
        {
          $percents = Percent::select('uuid', 'age',
                                    'sex', 'province', 'district',
                                    'health_facility', 'location', 'chw_phone',
                                    'mother_phone', 'zone', 'bcg',
                                    'opv', 'dtp', 'pcv', 'rota', 'measles','fully') 
                                    ->where('province', '=', $province) 
                                    ->where('district', '=', $district)
                                    ->where('health_facility', '=', $facility)
                                    ->where('zone', '=', $zone)   
                                    ->whereBetween('age', [0, 23]) 
                                    ->get();  
        }
        else
        {
          
        }
		 
		 $fully = 0;
		 $allChildren_12_23 = 0;
		 foreach ($percents as $child) {
		 	$age = $child->age;  
		 	$result = $child->fully;   
              
            if($age >= 12 and $age < 24)
            {
            	$allChildren_12_23 = $allChildren_12_23 + 1;
            	if($result == 1)
            	{
            	  $fully = $fully + 1; 
            	}
            }
		 }
		 $percent = round(($fully*100)/$allChildren_12_23);
		 $nofully = 100 - $percent;
		 $donnees = [
            $nofully, $percent
        ];
		 return response()->json(
		    $donnees
		);
		 //return view('blog.blogOne')->with('children',$children);
	}
}
