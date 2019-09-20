<?php
namespace blog\Http\Controllers\Children;

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
         if($roles == 'admin')
         {
            $provinces = Percent::select('province')
                    ->groupBy('province') 
                    ->get(); 
            return view('children.index')->with('provinces',$provinces);
         } 
      }

      public function getData(Request $request)
      {   

            $province =  $request->input('province');
            $district =  $request->input('district');
            $facility =  $request->input('facility');
            $zone     =  $request->input('zone'); 

            

        if($province == '' and $district == '' and $facility == '' and $zone == '')
        {
            $childrens = Percent::select('uuid', 'age','dob',
                        'sex', 'province', 'district',
                        'health_facility', 'location', 'chw_phone',
                        'mother_phone', 'zone', 'bcg',
                        'opv', 'dtp', 'pcv', 'rota', 'measles','fully','created_at','mvacc_id') 
                        ->whereBetween('age', [0, 23]) 
                        ->get(); 
        }
        elseif($province != '' and $district == '' and $facility == '' and $zone == '')
        {
            $childrens = Percent::select('uuid', 'age','dob',
                        'sex', 'province', 'district',
                        'health_facility', 'location', 'chw_phone',
                        'mother_phone', 'zone', 'bcg',
                        'opv', 'dtp', 'pcv', 'rota', 'measles','fully','created_at','mvacc_id') 
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
                        'opv', 'dtp', 'pcv', 'rota', 'measles','fully','created_at','mvacc_id') 
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
                          'opv', 'dtp', 'pcv', 'rota', 'measles','fully','created_at','mvacc_id') 
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
                         'opv', 'dtp', 'pcv', 'rota', 'measles','fully','created_at','mvacc_id') 
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
