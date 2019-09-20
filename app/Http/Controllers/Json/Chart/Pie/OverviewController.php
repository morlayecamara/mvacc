<?php

namespace blog\Http\Controllers\Json\Chart\Pie;

use Illuminate\Http\Request;
use blog\Percent; 
use blog\Http\Requests;
use blog\Http\Controllers\Controller;

class OverviewController extends Controller
{
    public function getData()
	{
		 //$childrens = Percent::all();
		$percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully')   
                                  ->whereBetween('age', [0, 23]) 
                                  ->get(); 
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
