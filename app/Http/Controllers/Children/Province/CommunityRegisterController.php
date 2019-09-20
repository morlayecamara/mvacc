<?php
namespace blog\Http\Controllers\Children\Province;

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
	        if($roles == 'viewer-province')
	        {
	            $province = Auth::user()->province; 
	            return view('children.province.index')->with('province',$province);
	        } 
            
      }

      public function getData(Request $request)
      {   

            $province =  Auth::user()->province;
            $district =  $request->input('district');
            $facility =  $request->input('facility');
            $zone     =  $request->input('zone'); 

            

        if($province == '' and $district == '' and $facility == '' and $zone == '')
        {
            $childrens = Percent::select('uuid', 'age','dob',
                        'sex', 'province', 'district',
                        'health_facility', 'location', 'chw_phone',
                        'mother_phone', 'zone', 'bcg',
                        'opv', 'dtp', 'pcv', 'rota', 'measles','fully','created_at') 
                        ->whereBetween('age', [0, 23]) 
                        ->get(); 
        }
        elseif($province != '' and $district == '' and $facility == '' and $zone == '')
        {
            $childrens = Percent::select('uuid', 'age','dob',
                        'sex', 'province', 'district',
                        'health_facility', 'location', 'chw_phone',
                        'mother_phone', 'zone', 'bcg',
                        'opv', 'dtp', 'pcv', 'rota', 'measles','fully','created_at') 
                        ->where('province', '=', $province)    
                        ->whereBetween('age', [0, 23]) 
                        ->get(); 
        }
        elseif($province != '' and $district != '' and $facility == '' and $zone == '')
        {
            $childrens = Percent::select('uuid', 'age','dob',
                        'sex', 'province', 'district',
                        'health_facility', 'location', 'chw_phone',
                        'mother_phone', 'zone', 'bcg',
                        'opv', 'dtp', 'pcv', 'rota', 'measles','fully','created_at') 
                        ->where('province', '=', $province)
                        ->where('district', '=', $district)    
                        ->whereBetween('age', [0, 23]) 
                        ->get(); 
        }
        elseif($province != '' and $district != '' and $facility != '' and $zone == '')
        {
             $childrens = Percent::select('uuid', 'age','dob',
                          'sex', 'province', 'district',
                          'health_facility', 'location', 'chw_phone',
                          'mother_phone', 'zone', 'bcg',
                          'opv', 'dtp', 'pcv', 'rota', 'measles','fully','created_at') 
                          ->where('province', '=', $province)
                          ->where('district', '=', $district) 
                          ->where('health_facility', '=', $facility)    
                          ->whereBetween('age', [0, 23]) 
                          ->get(); 
        }
        else
        {
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
        } 

        $data = array(
            'data'=>$childrens
          );
        return $data; 
      }

}
