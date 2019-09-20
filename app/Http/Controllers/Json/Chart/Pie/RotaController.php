<?php

namespace blog\Http\Controllers\Json\Chart\Pie;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Http\Controllers\Controller;
use blog\Percent;  

class RotaController extends Controller
{

   
    public function getData()
	{
		 $percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully')   
                                  ->whereBetween('age', [0, 23]) 
                                  ->get(); 
		 $vaccine = 0;
		 $allChildren_12_23 = 0;
		 foreach ($percents as $child) {
		 	$age = $child->age;  
		 	$result = $child->rota;   
              
            if($age >= 12 and $age < 24)
            {
            	$allChildren_12_23 = $allChildren_12_23 + 1;
            	if($result == 2)
            	{
            	  $vaccine = $vaccine + 1; 
            	}
            }
		 }
		 $percent = round(($vaccine*100)/$allChildren_12_23);
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
