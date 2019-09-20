<?php

namespace blog\Http\Controllers;

use Illuminate\Http\Request;
use View;
use File;
use Response;
use blog\Percent; 
use blog\Http\Requests;

class BlogController extends Controller
{
    public function blogOne(Request $request)
	{
		 //$percents = Percent::all();
		    $province =  $request->input('province');
        $district =  $request->input('district');
        $facility =  $request->input('facility');
        $zone     =  $request->input('zone');
        if($province == '' and $district == '' and $facility == '' and $zone == '')
        {
          $percents = Percent::select('uuid', 'age',
                                    'sex', 'province', 'district',
                                    'health_facility', 'location', 'chw_phone',
                                    'mother_phone', 'zone', 'bcg',
                                    'opv', 'dtp', 'pcv', 'rota', 'measles','fully')   
                                    ->get(); 
        }
        if($province != '' and $district == '' and $facility == '' and $zone == '')
        {
          $percents = Percent::select('uuid', 'age',
                                    'sex', 'province', 'district',
                                    'health_facility', 'location', 'chw_phone',
                                    'mother_phone', 'zone', 'bcg',
                                    'opv', 'dtp', 'pcv', 'rota', 'measles','fully') 
                                    ->where('province', '=', $province)   
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
                                    ->get();  
        }
        else
        {
          
        }
		    if(is_null($percents)) {
           return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }
		 $allpercent_0_23 = 0;
		 $allpercent_12_23 = 0;
		 $allpercent_18_23 = 0;
		 $male = 0;
		 $female = 0;
		 $male_all = 0;
		 $female_all = 0;
		 $male_12_23 = 0;
		 $female_12_23 = 0;
		 $male_18_23 = 0;
		 $female_18_23 = 0;
		 $all=count($percents);
		 $dataFile = array();

		 foreach ($percents as $child) {
		 	if($child->sex == 'Male')
            {
            	$male_all = $male_all + 1;
            }
            if($child->sex == 'Female')
            {
            	$female_all = $female_all + 1;
            }
		 	 
            $age = $child->age;
            if($age >= 0 and $age < 24)
            {
            	$allpercent_0_23 = $allpercent_0_23 + 1;
            	if($child->sex == 'Male')
            	{
            		 $male = $male + 1;
            	}
            	if($child->sex == 'Female')
            	{
            		 $female = $female + 1;
            	}
            }
            if($age >= 12 and $age < 24)
            {
            	$allpercent_12_23 = $allpercent_12_23 + 1;
            	if($child->sex == 'Male')
            	{
            		 $male_12_23 = $male_12_23 + 1;
            	}
            	if($child->sex == 'Female')
            	{
            		 $female_12_23 = $female_12_23 + 1;
            	}
            }
            if($age >= 18 and $age < 24)
            {
            	$allpercent_18_23 = $allpercent_18_23 + 1;
            	if($child->sex == 'Male')
            	{
            		 $male_18_23 = $male_18_23 + 1;
            	}
            	if($child->sex == 'Female')
            	{
            		 $female_18_23 = $female_18_23 + 1;
            	}
            }
		 }
		 if($allpercent_0_23 != 0){
		 	 $male = round(($male*100)/$allpercent_0_23);
		     $female = round(($female*100)/$allpercent_0_23);
		 }else{
		 	 $male = 0;
		   $female = 0;
		 }
		
		 if($allpercent_18_23 != 0){
		 	$male_18_23 = round(($male_18_23*100)/$allpercent_18_23);
		 	$female_18_23 = round(($female_18_23*100)/$allpercent_18_23);
		 }else{
		 	 $male_18_23 = 0;
		   $female_18_23 = 0;
		 }

		 if($allpercent_12_23 != 0){
		 	$male_12_23 = round(($male_12_23*100)/$allpercent_12_23);
		 	$female_12_23 = round(($female_12_23*100)/$allpercent_12_23);
		 }else{
		 	 $male_12_23 = 0;
		   $female_12_23 = 0;
		 }
		 if($all != 0){
		 	$male_all = round(($male_all*100)/$all);
		 	$female_all = round(($female_all*100)/$all);
		 }else{
		 	 $male_all = 0;
		   $female_all = 0;
		 }
		 $result = array(
		 	'valueall'=>$all, 'maleall'=> $male_all, 'femaleall'=>$female_all,
		 	'value'=>$allpercent_0_23, 'male'=> $male, 'female'=>$female,
		 	'value1223'=>$allpercent_12_23, 'male1223'=> $male_12_23, 'female1223'=>$female_12_23,
		 	'value1823'=>$allpercent_18_23, 'male1823'=> $male_18_23, 'female1823'=>$female_18_23
		 );

		 $dataFile[] = $result;
         $dataFile = json_encode($dataFile);
         
         $fileName = 'blogOne.blade.php';
         File::delete(public_path('/json/blog/'.$fileName)); 
         //var_dump(resource_path('/upload/json/'.$fileName));die();
         File::put(public_path('/json/blog/'.$fileName), $dataFile); 
		 return $dataFile;
		 //return view('blog.blogOne')->with('percent',$percent);
	}

	public function blogTwo()
	{
		 //$percents = Percent::all();
		$percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully')   
                                  ->whereBetween('age', [0, 23]) 
                                  ->get(); 
		 $fully = 0;
		 $allpercent_12_23 = 0;
		 $dataFile = array();
		 foreach ($percents as $child) {
		 	$age = $child->age; 
		 	$result = $child->fully;  
              
            if($age >= 12 and $age < 24)
            {
            	$allpercent_12_23 = $allpercent_12_23 + 1;
            	if($result == 1)
            	{
            	   $fully = $fully + 1; 
            	}
            }
		 }
		 $percent = round(($fully*100)/$allpercent_12_23);
		 $nofully = 100 -  $percent;
		 $resu_array = array('value'=>$fully, 'percent'=>$percent, 'nofully'=>$nofully);
		 
		 $dataFile[] = $resu_array;
         $dataFile = json_encode($dataFile);
         
         $fileName = 'blogTwo.blade.php';
         File::delete(public_path('/json/blog/'.$fileName)); 
         //var_dump(resource_path('/upload/json/'.$fileName));die();
         File::put(public_path('/json/blog/'.$fileName), $dataFile); 
		 return $dataFile;
		 //return view('blog.blogOne')->with('percent',$percent);
	}

	public function blogThree()
	{
		 //$percents = Percent::all();
		$percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully')   
                                  ->whereBetween('age', [0, 23]) 
                                  ->get(); 
		 $fully = 0;
		 $imeasles1 = 0;
		 $imeasles2 = 0;
		 $allpercent_12_23 = 0;
		 $dataFile = array();
		 foreach ($percents as $child) { 
		 	$measles = $child->measles;
            $age = $child->age;  

            if($age >= 12 and $age < 24)
            {
            	$allpercent_12_23 = $allpercent_12_23 + 1;
            	if($measles == 2)
            	{
                   $imeasles2 = $imeasles2 + 1; 
            	} 
            	if($measles >= 1)
            	{
                   $imeasles1 = $imeasles1 + 1; 
            	}
            }
		 }
		 $result = $imeasles1 - $imeasles2;
		 $percent = round(($result*100)/$allpercent_12_23);
		 $resu_array = array('value'=>$result, 'percent'=>$percent);
		 $dataFile[] = $resu_array;
         $dataFile = json_encode($dataFile);
         
         $fileName = 'blogThree.blade.php';
         File::delete(public_path('/json/blog/'.$fileName)); 
         //var_dump(resource_path('/upload/json/'.$fileName));die();
         File::put(public_path('/json/blog/'.$fileName), $dataFile); 
		 return $dataFile;
		 //return view('blog.blogOne')->with('percent',$percent);
	}

	public function blogFour()
	{
		 //$percents = Percent::all();
		$percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully')   
                                  ->whereBetween('age', [0, 23]) 
                                  ->get(); 
		 $fully = 0;
		 $idtp1 = 0;
		 $idtp3 = 0;
		 $allpercent_12_23 = 0;
		 $dataFile = array();
		 foreach ($percents as $child) { 
		 	$param = $child->dob;
            $age = $child->age; 
            $dtp = $child->dtp;  
            if($age >= 12 and $age < 24)
            {
            	$allpercent_12_23 = $allpercent_12_23 + 1;
            	if($dtp == 3)
            	{
                   $idtp3 = $idtp3 + 1; 
            	} 
            	if($dtp >= 1)
            	{
                   $idtp1 = $idtp1 + 1; 
            	}
            }
		 }
		 
         $result = $idtp1 - $idtp3;
         if($idtp1 != 0){
         	 $percent = round(($result*100)/$idtp1);
         }
         else{
         	 $percent = 0;
         }
		
		 $resu_array = array('value'=>$result, 'percent'=>$percent);

		 $dataFile[] = $resu_array;
         $dataFile = json_encode($dataFile);
         
         $fileName = 'blogFour.blade.php';
         File::delete(public_path('/json/blog/'.$fileName)); 
         //var_dump(resource_path('/upload/json/'.$fileName));die();
         File::put(public_path('/json/blog/'.$fileName), $dataFile); 
		 return $dataFile;
		 
		 //return view('blog.blogOne')->with('percent',$percent);
	}
}
