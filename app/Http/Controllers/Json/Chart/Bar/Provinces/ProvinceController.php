<?php

namespace blog\Http\Controllers\Json\Chart\Bar\Provinces;

use Illuminate\Http\Request;
use blog\Percent;  
use blog\Http\Requests;
use blog\Http\Controllers\Controller;

class ProvinceController extends Controller
{
      public function getData(Request $request)
	{
		     $donnees = array();
		     $allpercent_1223 = 0;
		     $res_fully = 0;
         $res_bcg = 0; 
         $res_opv = 0;  
         $res_dtp = 0; 
         $res_pcv = 0; 
         $res_rota = 0; 
         $res_measles = 0; 
         //$percents = Percent::all();
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
         
		 if (is_null($percents)) {
           return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
         }
		foreach ($percents as $child) {
            $age = $child->age; 
            if($age >= 12 and $age < 24)
            {
              $allpercent_1223 = $allpercent_1223 + 1;
              $bcg = $child->bcg;
              $opv = $child->opv;
              $dtp = $child->dtp;
              $pcv = $child->pcv;
              $rota = $child->rota;
              $measles = $child->measles;   
	             
	            if($bcg == 1)
	            {
	            	$res_bcg = $res_bcg + 1;
	            }
	            if($opv >= 3)
	            {
	            	$res_opv = $res_opv + 1;
	            }
	            if($dtp >= 3)
	            {
	            	$res_dtp = $res_dtp + 1;
	            }
	            if($pcv >= 3)
	            {
	            	$res_pcv = $res_pcv + 1;
	            }
	            if($rota >= 2)
	            {
	            	$res_rota = $res_rota + 1;
	            }
	            if($measles >= 1)
	            {
	            	$res_measles = $res_measles + 1;
	            }
            }//end if $age >= 0 and $age < 24
        }//end for foreach $percent
        if($allpercent_1223 != 0)
        {
          $percent_bcg = round(($res_bcg*100)/$allpercent_1223);
          $percent_opv = round(($res_opv*100)/$allpercent_1223); 
          $percent_dtp = round(($res_dtp*100)/$allpercent_1223);
          $percent_pcv = round(($res_pcv*100)/$allpercent_1223); 
          $percent_rota = round(($res_rota*100)/$allpercent_1223); 
          $percent_measles = round(($res_measles*100)/$allpercent_1223);
        }
        else
        {
          $percent_bcg = 0;
          $percent_opv = 0; 
          $percent_dtp = 0;
          $percent_pcv = 0; 
          $percent_rota = 0; 
          $percent_measles = 0;
        }

         $donnees = array(
                ['BCG', $percent_bcg],
                ['OPV', $percent_opv],
                ['DTP', $percent_dtp],
                ['PCV', $percent_pcv],
                ['Rota', $percent_rota],
                ['MR', $percent_measles]
        ); 

          return response()->json(
            $donnees
        );
	}
}
