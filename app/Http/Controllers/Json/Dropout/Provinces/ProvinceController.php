<?php

namespace blog\Http\Controllers\Json\Dropout\Provinces;

use Illuminate\Http\Request;
use blog\Http\Requests;
use blog\Percent; 
use blog\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    public function getData(Request $request)
    {
         
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
       $bcg_measles = 0;
       $measles_bcg = 0;
       $bcg_measles2 = 0; 
       $dtp_1 = 0;
       $dtp_3 = 0;
       $opv_1 = 0;
       $opv_3 = 0; 
       $pcv_1 = 0;
       $pcv_3 = 0;
       $rota_1 = 0;
       $rota_2 = 0;
       $measles_1 = 0;
       $measles_2 = 0;
       foreach ($percents as $child) {
            $age = $child->age;
            $bcg = $child->bcg;
            $opv = $child->opv;
            $dtp = $child->dtp;
            $pcv = $child->pcv;
            $rota = $child->rota;
            $measles = $child->measles; 
             
            if($age >= 12 and $age < 24)
            { 
	            if($bcg == 1){
	            	$bcg_measles = $bcg_measles + 1;
	            }
	            if($measles == 1){
	            	$measles_bcg = $measles_bcg + 1;
	            }
	            if($dtp >= 1){
	            	$dtp_1 = $dtp_1 + 1;
	            }
	            if($dtp == 3){
	            	$dtp_3 = $dtp_3 + 1;
	            }
	            if($pcv >= 1){
	            	$pcv_1 = $pcv_1 + 1;
	            }
	            if($pcv == 3){
	            	$pcv_3 = $pcv_3 + 1;
	            }
	            if($rota >= 1){
	            	$rota_1 = $rota_1 + 1;
	            }
	            if($rota == 2){
	            	$rota_2 = $rota_2 + 1;
	            }
                if($opv >= 1)
                {
                   $opv_1 = $opv_1 + 1; 
                }
	            if($opv >= 3)
	            { 
                   $opv_3 = $opv_3 + 1; 
	            }
	        }
	        if($age >= 18 and $age < 24)
            {
            	if($bcg == 1){
	            	$bcg_measles2 = $bcg_measles2 + 1;
	            }
            	if($measles >= 1){
	            	$measles_1 = $measles_1 + 1;
	            }
	            if($measles == 1){
	            	$measles_2 = $measles_2 + 1;
	            }
            } 
       
        }     
            if($bcg_measles != 0)
            { 
            	$do_bcg_mr1 = round((($bcg_measles-$measles_bcg)*100)/$bcg_measles);
            }
            else
            {
            	$do_bcg_mr1 = 0;
            }
            if($bcg_measles2 != 0)
            { 
            	$do_bcg_mr2 = round((($bcg_measles2-$measles_2)*100)/$bcg_measles2);
            }
            else
            {
            	$do_bcg_mr2 = 0;
            }
            if($dtp_1 != 0)
            { 
            	$do_dtp = round((($dtp_1-$dtp_3)*100)/$dtp_1);
            }
            else
            {
            	$do_dtp = 0;
            }
            if($pcv_1 != 0)
            { 
            	$do_pcv = round((($pcv_1-$pcv_3)*100)/$pcv_1);
            }
            else
            {
            	$do_pcv = 0;
            }
            if($rota_1 != 0)
            { 
            	$do_rota = round((($rota_1-$rota_2)*100)/$rota_1);
            }
            else
            {
            	$do_rota = 0;
            }
            if($measles_1 != 0)
            { 
            	$do_measles = round((($measles_1-$measles_2)*100)/$measles_1);
            }
            else
            {
            	$do_measles = 0;
            }
           
            if($opv_1 != 0)
            {
            	 $do_opv = round((($opv_1-$opv_3)*100)/$opv_1);
            }
            else
            {
            	 $do_opv = 0;
            } 

            $donnees = array(   
              ['label' =>'BCG-MR1','value' =>$do_bcg_mr1],
              ['label' =>'BCG-MR2','value' =>$do_bcg_mr2],
              ['label' =>'Rota','value' =>$do_rota],
              ['label' =>'OPV','value' =>$do_opv],
              ['label' =>'DTP','value' =>$do_dtp],
              ['label' =>'PCV','value' =>$do_pcv], 
              ['label' =>'MR','value' =>$do_measles]
          );  
       return $donnees;
   }
}
