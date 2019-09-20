<?php
namespace blog\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use blog\Percent; 
use blog\Children; 
use blog\Vaccine; 
use DB;
use blog\Http\Controllers\AgeController;

class AddChildrenController extends Controller
{

   public function index(Request $request)
   {   

	        $uuid           = $request->input('uuid');
	        $under5_id      = $request->input('under5_id');
	        $birth          = $request->input('birth');
	        $dob            = $request->input('dob'); 
	        $sex            = $request->input('sex'); 
	        $province       = $request->input('province');
	        $district       = $request->input('district');
	        $health_facility = $request->input('health_facility');
	        $location       = $request->input('location'); 
	        $chw_phone      = $request->input('chw_phone');
	        $mother_phone   = $request->input('mother_phone');  
	        $zone           = $request->input('zone');
	        $id             = $request->input('id');

      if ($uuid != ''  and $under5_id != ''  and $dob != ''  and $sex != ''  and $province != ''  and $district != ''  and $health_facility != '' and $location != '' and  $chw_phone != '' and $mother_phone != '' and $zone  != '' and $birth != ''  and $id != '') 
	   {
	  	  $dist_faci_zone = $district.$health_facility.$zone; 
	            $age = (new AgeController)->getAge($dob);   

                Children::create([
			        'uuid'            => $uuid,
			        'under5_id'       => $under5_id,
			        'Birth'           => $birth,
			        'dob'             => $dob, 
			        'sex'             => $sex,
			        'province'        => $province,
			        'district'        => $district,
			        'health_facility' => $health_facility, 
			        'location'        => $location, 
			        'chw_phone'       => $chw_phone,
			        'mother_phone'    => $mother_phone,
			        'zone'            => $zone,
			        'mvacc_id'        => $id, 
			        'dist_faci_zone'  => $dist_faci_zone, 
			        'age' => $age, 
		        ]);  
	    }
	    else
	    {
	    	echo 'error';
	    }
    
	           
     }

}
