<?php
namespace blog\Http\Controllers\Children\Zone;

use Illuminate\Http\Request;
use blog\Percent; 
use blog\Http\Controllers\Controller;
use Jenssegers\Date\Date;  
use blog\Http\Requests;
use blog\User;
use Auth; 

class CommunityRegisterController extends Controller
{

      public function index()
      {   
            $roles = Auth::user()->roles; 
	        if($roles == 'viewer-zone')
	        {
	            $province = Auth::user()->province;
	            $district = Auth::user()->district; 
	            $facility = Auth::user()->facility;
	            $zone     = Auth::user()->zone;
	            return view('children.zone.index')->with('province',$province)->with('district',$district)->with('facility',$facility)->with('zone',$zone);
	        } 
            
      }

      public function getData(Request $request)
      {   

            $province =  Auth::user()->province;
            $district =  Auth::user()->district; 
            $facility =  Auth::user()->facility; 
            $zone     =  Auth::user()->zone;  
      
            $childrens = Percent::select('uuid', 'age','dob',
                         'sex', 'province', 'district',
                         'health_facility', 'location', 'chw_phone',
                         'mother_phone', 'zone', 'bcg',
                         'opv', 'dtp', 'pcv', 'rota', 'measles','fully','created_at') 
                         ->where('province', '=', $province)
                         ->where('district', '=', $district) 
                         ->where('health_facility', '=', $facility)
                         ->where('zone', '=', $zone)    
                         ->whereBetween('age', [0, 23]) 
                         ->get(); 
      

        $data = array(
            'data'=>$childrens
          );
        return $data; 
      }

}
