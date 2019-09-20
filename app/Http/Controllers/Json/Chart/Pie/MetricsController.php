<?php

namespace blog\Http\Controllers\Json\Chart\Pie;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Http\Controllers\Controller;
use blog\Percent; 
use blog\Vaccine;  
use blog\Http\Controllers\AgeController;
use blog\User;
use Auth; 

class MetricsController extends Controller
{
       

      public function getData()
        {
             //$percent = Percent::all(); 
            $roles = Auth::user()->roles;
            $prov = Auth::user()->province;
            $dist = Auth::user()->district; 
            $faci = Auth::user()->facility;
            $zone     = Auth::user()->zone;

            if($roles == 'admin')
            {
               $percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully')   
                                  ->whereBetween('age', [0, 23]) 
                                  ->get(); 
            }

            if($roles == 'viewer-province')
            {
               $percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully')  
                                  ->where('province', '=', $prov)   
                                  ->whereBetween('age', [0, 23]) 
                                  ->get(); 
            }

            if($roles == 'viewer-district')
            {
               $percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully')  
                                   ->where('province', '=', $prov)  
                                   ->where('district', '=', $dist)  
                                  ->whereBetween('age', [0, 23]) 
                                  ->get(); 
            }

            if($roles == 'viewer-facility')
            {
               $percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully') 
                                   ->where('province', '=', $prov)  
                                   ->where('district', '=', $dist) 
                                   ->where('health_facility', '=', $faci)  
                                  ->whereBetween('age', [0, 23]) 
                                  ->get(); 
            }

            if($roles == 'viewer-zone')
            {
               $percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully')
                                   ->where('province', '=', $prov)  
                                   ->where('district', '=', $dist) 
                                   ->where('health_facility', '=', $faci) 
                                   ->where('zone', '=', $zone)     
                                  ->whereBetween('age', [0, 23]) 
                                  ->get(); 
            }
           
             $allChildren = 0;
             $allChildren_0_6 = 0;
             $allChildren_6_12 = 0;
             $allChildren_12_18 = 0;
             $allChildren_18_23 = 0;
             foreach ($percents as $child) { 

                        $age = $child->age;  
                        $allChildren = $allChildren + 1;
                          
                        if($age >= 0 and $age < 6)
                        {
                              $allChildren_0_6 = $allChildren_0_6 + 1; 
                        }
                        if($age >= 6 and $age < 12)
                        {
                              $allChildren_6_12 = $allChildren_6_12 + 1; 
                        }
                        if($age >= 12 and $age < 18)
                        {
                              $allChildren_12_18 = $allChildren_12_18 + 1; 
                        }
                        if($age >= 18 and $age < 24)
                        {
                              $allChildren_18_23 = $allChildren_18_23 + 1; 
                        }
                        }

                         
                         if($allChildren != 0)
                         {
                              $percent06   = round(($allChildren_0_6*100)/$allChildren);
                              $percent612  = round(($allChildren_6_12*100)/$allChildren);
                              $percent1218 = round(($allChildren_12_18*100)/$allChildren);
                              $percent1823 = round(($allChildren_18_23*100)/$allChildren);
                         }
                         
                         $donnees = [
                        $percent06, $percent612,$percent1218, $percent1823
                    ];
                         return response()->json(
                            $donnees
                        );
                        
                  }
}
