<?php

namespace blog\Http\Controllers\Json\Tab;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Percent;  
use blog\Http\Controllers\Controller; 

class OverviewController extends Controller
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
         $donnees = array();
         $allChildren = 0;
         $allChildren_prov = 0; 
         $allChildren_023 = 0;
         $allChildren_prov023 = 0;
         $allChildren_1223 = 0;
         $allChildren_prov1223 = 0;
         $allChildren_1823 = 0;
         $allChildren_prov1823 = 0;
         $allChildren_011 = 0;
         $allChildren_prov011 = 0;
         $prov_fully = 0;
         $prov_bcg = 0; 
         $prov_opv = 0;  
         $prov_dtp = 0; 
         $prov_pcv = 0; 
         $prov_rota = 0; 
         $prov_measles = 0;   

         $allChildren_Western = 0;
         $allChildren_prov_Western = 0; 
         $allChildren_023_Western = 0;
         $allChildren_prov023_Western = 0;
         $allChildren_1223_Western = 0;
         $allChildren_prov1223_Western = 0;
         $allChildren_1823_Western = 0;
         $allChildren_prov1823_Western = 0;
         $allChildren_011_Western = 0;
         $allChildren_prov011_Western = 0;
         $prov_fully_Western = 0;
         $prov_bcg_Western = 0; 
         $prov_opv_Western = 0;  
         $prov_dtp_Western = 0; 
         $prov_pcv_Western = 0; 
         $prov_rota_Western = 0; 
         $prov_measles_Western = 0;  

         $allChildren_Northern = 0;
         $allChildren_prov_Northern = 0; 
         $allChildren_023_Northern = 0;
         $allChildren_prov023_Northern = 0;
         $allChildren_1223_Northern = 0;
         $allChildren_prov1223_Northern = 0;
         $allChildren_1823_Northern = 0;
         $allChildren_prov1823_Northern = 0;
         $allChildren_011_Northern = 0;
         $allChildren_prov011_Northern = 0;
         $prov_fully_Northern = 0;
         $prov_bcg_Northern = 0; 
         $prov_opv_Northern = 0; 
         $prov_dtp_Northern = 0; 
         $prov_pcv_Northern = 0; 
         $prov_rota_Northern = 0; 
         $prov_measles_Northern = 0;  

         $allChildren_NorthWestern = 0;
         $allChildren_prov_NorthWestern = 0; 
         $allChildren_023_NorthWestern = 0;
         $allChildren_prov023_NorthWestern = 0;
         $allChildren_1223_NorthWestern = 0;
         $allChildren_prov1223_NorthWestern = 0;
         $allChildren_1823_NorthWestern = 0;
         $allChildren_prov1823_NorthWestern = 0;
         $allChildren_011_NorthWestern = 0;
         $allChildren_prov011_NorthWestern = 0;
         $prov_fully_NorthWestern = 0;
         $prov_bcg_NorthWestern = 0; 
         $prov_opv_NorthWestern = 0; 
         $prov_dtp_NorthWestern = 0; 
         $prov_pcv_NorthWestern = 0; 
         $prov_rota_NorthWestern = 0; 
         $prov_measles_NorthWestern = 0;  

         $allChildren_Muchinga = 0;
         $allChildren_prov_Muchinga = 0; 
         $allChildren_023_Muchinga = 0;
         $allChildren_prov023_Muchinga = 0;
         $allChildren_1223_Muchinga = 0;
         $allChildren_prov1223_Muchinga = 0;
         $allChildren_1823_Muchinga = 0;
         $allChildren_prov1823_Muchinga = 0;
         $allChildren_011_Muchinga = 0;
         $allChildren_prov011_Muchinga = 0;
         $prov_fully_Muchinga = 0;
         $prov_bcg_Muchinga = 0; 
         $prov_opv_Muchinga = 0; 
         $prov_dtp_Muchinga = 0;  
         $prov_pcv_Muchinga = 0; 
         $prov_rota_Muchinga = 0; 
         $prov_measles_Muchinga = 0;  

         $allChildren_Lusaka = 0;
         $allChildren_prov_Lusaka = 0; 
         $allChildren_023_Lusaka = 0;
         $allChildren_prov023_Lusaka = 0;
         $allChildren_1223_Lusaka = 0;
         $allChildren_prov1223_Lusaka = 0;
         $allChildren_1823_Lusaka = 0;
         $allChildren_prov1823_Lusaka = 0;
         $allChildren_011_Lusaka = 0;
         $allChildren_prov011_Lusaka = 0;
         $prov_fully_Lusaka = 0;
         $prov_bcg_Lusaka = 0; 
         $prov_opv_Lusaka = 0; 
         $prov_dtp_Lusaka = 0; 
         $prov_pcv_Lusaka = 0; 
         $prov_rota_Lusaka = 0; 
         $prov_measles_Lusaka = 0;  

         $allChildren_Luapula = 0;
         $allChildren_prov_Luapula = 0; 
         $allChildren_023_Luapula = 0;
         $allChildren_prov023_Luapula = 0;
         $allChildren_1223_Luapula = 0;
         $allChildren_prov1223_Luapula = 0;
         $allChildren_1823_Luapula = 0;
         $allChildren_prov1823_Luapula = 0;
         $allChildren_011_Luapula = 0;
         $allChildren_prov011_Luapula = 0;
         $prov_fully_Luapula = 0;
         $prov_bcg_Luapula = 0; 
         $prov_opv_Luapula= 0;  
         $prov_dtp_Luapula = 0; 
         $prov_pcv_Luapula = 0; 
         $prov_rota_Luapula = 0; 
         $prov_measles_Luapula = 0;  

         $allChildren_Eastern = 0;
         $allChildren_prov_Eastern = 0; 
         $allChildren_023_Eastern = 0;
         $allChildren_prov023_Eastern = 0;
         $allChildren_1223_Eastern = 0;
         $allChildren_prov1223_Eastern = 0;
         $allChildren_1823_Eastern = 0;
         $allChildren_prov1823_Eastern = 0;
         $allChildren_011_Eastern = 0;
         $allChildren_prov011_Eastern = 0;
         $prov_fully_Eastern = 0;
         $prov_bcg_Eastern = 0; 
         $prov_opv_Eastern = 0; 
         $prov_dtp_Eastern = 0; 
         $prov_pcv_Eastern = 0; 
         $prov_rota_Eastern = 0; 
         $prov_measles_Eastern = 0; 

         $allChildren_Copperbelt = 0;
         $allChildren_prov_Copperbelt = 0; 
         $allChildren_023_Copperbelt = 0;
         $allChildren_prov023_Copperbelt = 0;
         $allChildren_1223_Copperbelt = 0;
         $allChildren_prov1223_Copperbelt = 0;
         $allChildren_1823_Copperbelt = 0;
         $allChildren_prov1823_Copperbelt = 0;
         $allChildren_011_Copperbelt = 0;
         $allChildren_prov011_Copperbelt = 0;
         $prov_fully_Copperbelt = 0;
         $prov_bcg_Copperbelt = 0; 
         $prov_opv_Copperbelt = 0; 
         $prov_dtp_Copperbelt = 0; 
         $prov_pcv_Copperbelt = 0; 
         $prov_rota_Copperbelt = 0; 
         $prov_measles_Copperbelt = 0;  

         $allChildren_Central = 0;
         $allChildren_prov_Central = 0; 
         $allChildren_023_Central = 0;
         $allChildren_prov023_Central = 0;
         $allChildren_1223_Central = 0;
         $allChildren_prov1223_Central = 0;
         $allChildren_1823_Central = 0;
         $allChildren_prov1823_Central = 0;
         $allChildren_011_Central = 0;
         $allChildren_prov011_Central = 0;
         $prov_fully_Central = 0;
         $prov_bcg_Central = 0; 
         $prov_opv_Central = 0; 
         $prov_dtp_Central = 0; 
         $prov_pcv_Central = 0;  
         $prov_rota_Central = 0; 
         $prov_measles_Central = 0; 
         
         foreach ($percents as $child) {
            $age = $child->age; 
            if($age >= 0 and $age < 24)
            {
              $bcg = $child->bcg; 
              $opv = $child->opv; 
              $dtp = $child->dtp; 
              $pcv = $child->pcv; 
              $rota = $child->rota; 
              $measles = $child->measles; 
              $fully = $child->fully; 
              $province = $child->province; 
              $district = $child->district; 
              $facility = $child->health_facility; 
              $zone = $child->zone;
              $chw_phone = $child->chw_phone; 
              $mother_phone = $child->mother_phone;  
              $location = $child->location;
              $sex = $child->sex;
              
          
            if($province == 'Southern')
            {  
              $allChildren_prov = $allChildren_prov + 1; 
            } 

            if($province == 'Central')
            {  
              $allChildren_prov_Central = $allChildren_prov_Central + 1; 
            }

            if($province == 'Copperbelt')
            {  
              $allChildren_prov_Copperbelt = $allChildren_prov_Copperbelt + 1; 
            } 

            if($province == 'Eastern')
            {  
              $allChildren_prov_Eastern = $allChildren_prov_Eastern + 1; 
            } 

            if($province == 'Luapula')
            {  
              $allChildren_prov_Luapula = $allChildren_prov_Luapula + 1; 
            } 

            if($province == 'Lusaka')
            {  
              $allChildren_prov_Lusaka = $allChildren_prov_Lusaka + 1; 
            } 

            if($province == 'Muchinga')
            {  
              $allChildren_prov_Muchinga = $allChildren_prov_Muchinga + 1; 
            } 

            if($province == 'North-Western')
            {  
              $allChildren_prov_NorthWestern = $allChildren_prov_NorthWestern + 1; 
            } 

            if($province == 'Northern')
            {  
              $allChildren_prov_Northern = $allChildren_prov_Northern + 1; 
            } 
            
            if($province == 'Western')
            {  
              $allChildren_prov_Western = $allChildren_prov_Western + 1; 
            } 

            if($age >= 0 and $age < 12)
            {
              if($province == 'Southern')
              {  
                  $allChildren_prov011 = $allChildren_prov011 + 1; 
              } 
              if($province == 'Central')
              {  
                  $allChildren_prov011_Central = $allChildren_prov011_Central + 1; 
              } 
              if($province == 'Copperbelt')
              {  
                  $allChildren_prov011_Copperbelt = $allChildren_prov011_Copperbelt + 1; 
              }
              if($province == 'Eastern')
              {  
                  $allChildren_prov011_Eastern = $allChildren_prov011_Eastern + 1; 
              }
              if($province == 'Luapula')
              {  
                  $allChildren_prov011_Luapula = $allChildren_prov011_Luapula + 1; 
              } 
              if($province == 'Lusaka')
              {  
                  $allChildren_prov011_Lusaka = $allChildren_prov011_Lusaka + 1; 
              } 
              if($province == 'Muchinga')
              {  
                  $allChildren_prov011_Muchinga = $allChildren_prov011_Muchinga + 1; 
              } 
              if($province == 'North-Western')
              {  
                  $allChildren_prov011_NorthWestern = $allChildren_prov011_NorthWestern + 1; 
              } 
              if($province == 'Northern')
              {  
                  $allChildren_prov011_Northern = $allChildren_prov011_Northern + 1; 
              } 
              if($province == 'Western')
              {  
                  $allChildren_prov011_Western = $allChildren_prov011_Western + 1; 
              }  
            }//end if $age >= 0 and $age < 12
            if($age >= 0 and $age < 24)
            { 
              if($province == 'Southern')
              {  
                  $allChildren_prov023 = $allChildren_prov023 + 1; 
              }
              if($province == 'Central')
              {  
                  $allChildren_prov023_Central = $allChildren_prov023_Central + 1; 
              } 
              if($province == 'Copperbelt')
              {  
                  $allChildren_prov023_Copperbelt = $allChildren_prov023_Copperbelt + 1; 
              } 
              if($province == 'Eastern')
              {  
                  $allChildren_prov023_Eastern = $allChildren_prov023_Eastern + 1; 
              } 
              if($province == 'Luapula')
              {  
                  $allChildren_prov023_Luapula = $allChildren_prov023_Luapula + 1; 
              }  
              if($province == 'Lusaka')
              {  
                  $allChildren_prov023_Lusaka = $allChildren_prov023_Lusaka + 1; 
              }
              if($province == 'Muchinga')
              {  
                  $allChildren_prov023_Muchinga = $allChildren_prov023_Muchinga + 1; 
              }
              if($province == 'North-Western')
              {  
                  $allChildren_prov023_NorthWestern = $allChildren_prov023_NorthWestern + 1; 
              } 
              if($province == 'Northern')
              {  
                  $allChildren_prov023_Northern = $allChildren_prov023_Northern + 1; 
              } 
              if($province == 'Western')
              {  
                  $allChildren_prov023_Western = $allChildren_prov023_Western + 1; 
              }  
            }//end if $age >= 0 and $age < 24
            if($age >= 12 and $age < 24)
            {
              if($province == 'Southern')
              {  
                  $allChildren_prov1223 = $allChildren_prov1223 + 1; 
                  if($bcg == 1)
                  {
                    $prov_bcg = $prov_bcg + 1;
                  }
                  if($opv >= 3)
                  {
                    $prov_opv = $prov_opv + 1;
                  }
                  
                  if($dtp == 3)
                  {
                    $prov_dtp = $prov_dtp + 1;
                  } 
                  if($pcv == 3)
                  {
                    $prov_pcv = $prov_pcv + 1;
                  }
                   
                  if($rota == 2)
                  {
                    $prov_rota = $prov_rota + 1;
                  }  
                  if($measles >= 1)
                  {
                    $prov_measles = $prov_measles + 1;
                  }
                } 

                if($province == 'Central')
                {  
                  $allChildren_prov1223_Central = $allChildren_prov1223_Central + 1; 
                 if($bcg == 1)
                  {
                    $prov_bcg_Central = $prov_bcg_Central + 1;
                  }
                  if($opv >= 3)
                  {
                    $prov_opv_Central = $prov_opv_Central + 1;
                  }
                  
                  if($dtp == 3)
                  {
                    $prov_dtp_Central = $prov_dtp_Central + 1;
                  } 
                  if($pcv == 3)
                  {
                    $prov_pcv_Central = $prov_pcv_Central + 1;
                  }
                   
                  if($rota == 2)
                  {
                    $prov_rota_Central = $prov_rota_Central + 1;
                  }  
                  if($measles >= 1)
                  {
                    $prov_measles_Central= $prov_measles_Central + 1;
                  }
                }
                if($province == 'Copperbelt')
                {  
                  $allChildren_prov1223_Copperbelt = $allChildren_prov1223_Copperbelt + 1; 
                 if($bcg == 1)
                  {
                    $prov_bcg_Copperbelt = $prov_bcg_Copperbelt + 1;
                  }
                  if($opv >= 3)
                  {
                    $prov_opv_Copperbelt = $prov_opv_Copperbelt + 1;
                  }
                  
                  if($dtp == 3)
                  {
                    $prov_dtp_Copperbelt = $prov_dtp_Copperbelt + 1;
                  } 
                  if($pcv == 3)
                  {
                    $prov_pcv_Copperbelt = $prov_pcv_Copperbelt + 1;
                  }
                   
                  if($rota == 2)
                  {
                    $prov_rota_Copperbelt = $prov_rota_Copperbelt + 1;
                  }  
                  if($measles >= 1)
                  {
                    $prov_measles_Copperbelt = $prov_measles_Copperbelt + 1;
                  }
                }  
                if($province == 'Eastern')
                {  
                  $allChildren_prov1223_Eastern = $allChildren_prov1223_Eastern + 1; 
                 if($bcg == 1)
                  {
                    $prov_bcg_Eastern = $prov_bcg_Eastern + 1;
                  }
                  if($opv >= 3)
                  {
                    $prov_opv_Eastern = $prov_opv_Eastern + 1;
                  }
                  
                  if($dtp == 3)
                  {
                    $prov_dtp_Eastern = $prov_dtp_Eastern + 1;
                  } 
                  if($pcv == 3)
                  {
                    $prov_pcv_Eastern = $prov_pcv_Eastern + 1;
                  }
                   
                  if($rota == 2)
                  {
                    $prov_rota_Eastern = $prov_rota_Eastern + 1;
                  } 
                  if($measles >= 1)
                  {
                    $prov_measles_Eastern = $prov_measles_Eastern + 1;
                  }
                } 
                if($province == 'Luapula')
                {  
                  $allChildren_prov1223_Luapula = $allChildren_prov1223_Luapula + 1; 
                 if($bcg == 1)
                  {
                    $prov_bcg_Luapula = $prov_bcg_Luapula + 1;
                  }
                  if($opv >= 3)
                  {
                    $prov_opv_Luapula = $prov_opv_Luapula + 1;
                  }
                  
                  if($dtp == 3)
                  {
                    $prov_dtp_Luapula = $prov_dtp_Luapula + 1;
                  } 
                  if($pcv == 3)
                  {
                    $prov_pcv_Luapula = $prov_pcv_Luapula + 1;
                  }
                   
                  if($rota == 2)
                  {
                    $prov_rota_Luapula = $prov_rota_Luapula + 1;
                  }  
                  if($measles >= 1)
                  {
                    $prov_measles_Luapula = $prov_measles_Luapula + 1;
                  }
                } 
                if($province == 'Lusaka')
                {  
                  $allChildren_prov1223_Lusaka = $allChildren_prov1223_Lusaka + 1; 
                  if($bcg == 1)
                  {
                    $prov_bcg_Lusaka = $prov_bcg_Lusaka + 1;
                  }
                  if($opv >= 3)
                  {
                    $prov_opv_Lusaka = $prov_opv_Lusaka + 1;
                  }
                  
                  if($dtp == 3)
                  {
                    $prov_dtp_Lusaka = $prov_dtp_Lusaka + 1;
                  } 
                  if($pcv == 3)
                  {
                    $prov_pcv_Lusaka = $prov_pcv_Lusaka + 1;
                  } 
                  if($rota == 2)
                  {
                    $prov_rota_Lusaka = $prov_rota_Lusaka + 1;
                  }
                  if($measles >= 1)
                  {
                    $prov_measles_Lusaka = $prov_measles_Lusaka + 1;
                  }
                } 
                if($province == 'Muchinga')
                {  
                  $allChildren_prov1223_Muchinga = $allChildren_prov1223_Muchinga + 1; 
                 if($bcg == 1)
                  {
                    $prov_bcg_Muchinga = $prov_bcg_Muchinga + 1;
                  }
                  if($opv >= 3)
                  {
                    $prov_opv_Muchinga = $prov_opv_Muchinga + 1;
                  }
                  
                  if($dtp == 3)
                  {
                    $prov_dtp_Muchinga = $prov_dtp_Muchinga + 1;
                  } 
                  if($pcv == 3)
                  {
                    $prov_pcv_Muchinga = $prov_pcv_Muchinga + 1;
                  } 
                  if($rota == 2)
                  {
                    $prov_rota_Muchinga = $prov_rota_Muchinga + 1;
                  }  
                  if($measles >= 1)
                  {
                    $prov_measles_Muchinga = $prov_measles_Muchinga + 1;
                  }
                }
                if($province == 'North-Western')
                {  
                  $allChildren_prov1223_NorthWestern = $allChildren_prov1223_NorthWestern + 1; 
                 if($bcg == 1)
                  {
                    $prov_bcg_NorthWestern = $prov_bcg_NorthWestern + 1;
                  }
                  if($opv >= 3)
                  {
                    $prov_opv_NorthWestern = $prov_opv_NorthWestern + 1;
                  }
                  
                  if($dtp == 3)
                  {
                    $prov_dtp_NorthWestern = $prov_dtp_NorthWestern + 1;
                  } 
                  if($pcv == 3)
                  {
                    $prov_pcv_NorthWestern = $prov_pcv_NorthWestern + 1;
                  }
                   
                  if($rota == 2)
                  {
                    $prov_rota_NorthWestern = $prov_rota_NorthWestern + 1;
                  }  
                  if($measles >= 1)
                  {
                    $prov_measles_NorthWestern = $prov_measles_NorthWestern + 1;
                  }
                }
                if($province == 'Northern')
                {  
                  $allChildren_prov1223_Northern = $allChildren_prov1223_Northern + 1; 
                 if($bcg == 1)
                  {
                    $prov_bcg_Northern = $prov_bcg_Northern + 1;
                  }
                  if($opv >= 3)
                  {
                    $prov_opv_Northern = $prov_opv_Northern + 1;
                  }
                  
                  if($dtp == 3)
                  {
                    $prov_dtp_Northern = $prov_dtp_Northern + 1;
                  } 
                  if($pcv == 3)
                  {
                    $prov_pcv_Northern = $prov_pcv_Northern + 1;
                  } 
                  if($rota == 2)
                  {
                    $prov_rota_Northern = $prov_rota_Northern + 1;
                  } 
                  if($measles >= 1)
                  {
                    $prov_measles_Northern = $prov_measles_Northern + 1;
                  }
                }
                if($province == 'Western')
                {  
                  $allChildren_prov1223_Western = $allChildren_prov1223_Western + 1; 
                 if($bcg == 1)
                  {
                    $prov_bcg_Western = $prov_bcg_Western + 1;
                  }
                  if($opv >= 3)
                  {
                    $prov_opv_Western = $prov_opv_Western + 1;
                  }
                  
                  if($dtp == 3)
                  {
                    $prov_dtp_Western = $prov_dtp_Western + 1;
                  } 
                  if($pcv == 3)
                  {
                    $prov_pcv_Western = $prov_pcv_Western + 1;
                  }
                   
                  if($rota == 2)
                  {
                    $prov_rota_Western = $prov_rota_Western + 1;
                  }  
                  if($measles >= 1)
                  {
                    $prov_measles_Western = $prov_measles_Western + 1;
                  }
                }
            
              if($province == 'Southern')
              {  
                  $allChildren_prov1823 = $allChildren_prov1823 + 1; 
                  if($fully == 1)
                  {
                    $prov_fully = $prov_fully + 1;
                  }
               } 
               if($province == 'Central')
               {  
                  $allChildren_prov1823_Central = $allChildren_prov1823_Central + 1; 
                  if($fully == 1)
                  {
                    $prov_fully_Central = $prov_fully_Central + 1;
                  } 
                }  
                if($province == 'Copperbelt')
                {  
                  $allChildren_prov1823_Copperbelt = $allChildren_prov1823_Copperbelt + 1; 
                  if($fully == 1)
                  {
                    $prov_fully_Copperbelt = $prov_fully_Copperbelt + 1;
                  }  
                }
                if($province == 'Eastern')
                {  
                  $allChildren_prov1823_Eastern = $allChildren_prov1823_Eastern + 1; 
                  if($fully == 1)
                  {
                    $prov_fully_Eastern = $prov_fully_Eastern + 1;
                  } 
                }  
                if($province == 'Luapula')
                {  
                  $allChildren_prov1823_Luapula = $allChildren_prov1823_Luapula + 1; 
                  if($fully == 1)
                  {
                    $prov_fully_Luapula = $prov_fully_Luapula + 1;
                  }
                } 
                if($province == 'Lusaka')
                {  
                  $allChildren_prov1823_Lusaka = $allChildren_prov1823_Lusaka + 1; 
                  if($fully == 1)
                  {
                    $prov_fully_Lusaka = $prov_fully_Lusaka + 1;
                  } 
                } 
                if($province == 'Muchinga')
                {  
                  $allChildren_prov1823_Muchinga = $allChildren_prov1823_Muchinga + 1; 
                  if($fully == 1)
                  {
                    $prov_fully_Muchinga = $prov_fully_Muchinga + 1;
                  } 
                } 
                if($province == 'North-Western')
                {  
                  $allChildren_prov1823_NorthWestern = $allChildren_prov1823_NorthWestern + 1; 
                  if($fully == 1)
                  {
                    $prov_fully_NorthWestern = $prov_fully_NorthWestern + 1;
                  } 
                } 
                if($province == 'Northern')
                {  
                  $allChildren_prov1823_Northern = $allChildren_prov1823_Northern + 1; 
                  if($fully == 1)
                  {
                    $prov_fully_Northern = $prov_fully_Northern + 1;
                  } 
                } 
                if($province == 'Western')
                {  
                  $allChildren_prov1823_Western = $allChildren_prov1823_Western + 1; 
                  if($fully == 1)
                  {
                    $prov_fully_Western = $prov_fully_Western + 1;
                  }
                } 
            }//end if $age >= 12 and $age < 24
         
            }//end if $age >= 0 and $age < 24
        }//end for foreach $childrens
     
        //Southern
        
        if($allChildren_prov1223 != 0)
        {
          $percent_bcg = round(($prov_bcg*100)/$allChildren_prov1223); 
          $percent_opv = round(($prov_opv*100)/$allChildren_prov1223);
          $percent_dtp = round(($prov_dtp*100)/$allChildren_prov1223); 
          $percent_pcv = round(($prov_pcv*100)/$allChildren_prov1223);
          $percent_rota = round(($prov_rota*100)/$allChildren_prov1223);
          $percent_measles = round(($prov_measles*100)/$allChildren_prov1223);
          $percent_fully = round(($prov_fully*100)/$allChildren_prov1223); 
        }
        else
        {
          $percent_bcg = 0; 
          $percent_opv = 0;
          $percent_dtp = 0; 
          $percent_pcv = 0;
          $percent_rota = 0;
          $percent_measles = 0;
          $percent_fully = 0;
        }
        
        //end Southern

        //Central 
        if($allChildren_prov1223_Central != 0)
        {
          $percent_bcg_Central = round(($prov_bcg_Central*100)/$allChildren_prov1223_Central); 
          $percent_opv_Central = round(($prov_opv_Central*100)/$allChildren_prov1223_Central);
          $percent_dtp_Central = round(($prov_dtp_Central*100)/$allChildren_prov1223_Central); 
          $percent_pcv_Central = round(($prov_pcv_Central*100)/$allChildren_prov1223_Central);
          $percent_rota_Central = round(($prov_rota_Central*100)/$allChildren_prov1223_Central); 
          $percent_measles_Central = round(($prov_measles_Central*100)/$allChildren_prov1223_Central);
          $percent_fully_Central = round(($prov_fully_Central*100)/$allChildren_prov1223_Central);
        }
        else
        {
          $percent_bcg_Central = 0; 
          $percent_opv_Central = 0;
          $percent_dtp_Central = 0; 
          $percent_pcv_Central = 0;
          $percent_rota_Central = 0;
          $percent_measles_Central = 0;
          $percent_fully_Central = 0;
        }
       //end Central

        //Copperbelt
        
        if($allChildren_prov1223_Copperbelt != 0)
        {
          $percent_bcg_Copperbelt = round(($prov_bcg_Copperbelt*100)/$allChildren_prov1223_Copperbelt); 
          $percent_opv_Copperbelt = round(($prov_opv_Copperbelt*100)/$allChildren_prov1223_Copperbelt);
          $percent_dtp_Copperbelt = round(($prov_dtp_Copperbelt*100)/$allChildren_prov1223_Copperbelt); 
          $percent_pcv_Copperbelt = round(($prov_pcv_Copperbelt*100)/$allChildren_prov1223_Copperbelt);
          $percent_rota_Copperbelt = round(($prov_rota_Copperbelt*100)/$allChildren_prov1223_Copperbelt); 
          $percent_measles_Copperbelt = round(($prov_measles_Copperbelt*100)/$allChildren_prov1223_Copperbelt);
          $percent_fully_Copperbelt = round(($prov_fully_Copperbelt*100)/$allChildren_prov1223_Copperbelt); 
        }
        else
        {
          $percent_bcg_Copperbelt = 0; 
          $percent_opv_Copperbelt = 0;
          $percent_dtp_Copperbelt = 0; 
          $percent_pcv_Copperbelt = 0;
          $percent_rota_Copperbelt = 0;
          $percent_measles_Copperbelt = 0;
          $percent_fully_Copperbelt = 0; 
        }
        
       //end Copperbelt

         //Eastern
         
        if($allChildren_prov1223_Eastern != 0)
        {
          $percent_bcg_Eastern = round(($prov_bcg_Eastern*100)/$allChildren_prov1223_Eastern); 
          $percent_opv_Eastern = round(($prov_opv_Eastern*100)/$allChildren_prov1223_Eastern);
          $percent_dtp_Eastern = round(($prov_dtp_Eastern*100)/$allChildren_prov1223_Eastern); 
          $percent_pcv_Eastern = round(($prov_pcv_Eastern*100)/$allChildren_prov1223_Eastern);
          $percent_rota_Eastern = round(($prov_rota_Eastern*100)/$allChildren_prov1223_Eastern);
          $percent_measles_Eastern = round(($prov_measles_Eastern*100)/$allChildren_prov1223_Eastern);
          $percent_fully_Eastern = round(($prov_fully_Eastern*100)/$allChildren_prov1223_Eastern); 
        }
        else
        {
          $percent_bcg_Eastern = 0; 
          $percent_opv_Eastern = 0;
          $percent_dtp_Eastern = 0; 
          $percent_pcv_Eastern = 0;
          $percent_rota_Eastern = 0;
          $percent_measles_Eastern = 0;
          $percent_fully_Eastern = 0;
        }
        
       //end Eastern

        //Luapula
        
        if($allChildren_prov1223_Luapula != 0)
        {
          $percent_bcg_Luapula = round(($prov_bcg_Luapula*100)/$allChildren_prov1223_Luapula); 
          $percent_opv_Luapula = round(($prov_opv_Luapula*100)/$allChildren_prov1223_Luapula);
          $percent_dtp_Luapula = round(($prov_dtp_Luapula*100)/$allChildren_prov1223_Luapula); 
          $percent_pcv_Luapula = round(($prov_pcv_Luapula*100)/$allChildren_prov1223_Luapula);
          $percent_rota_Luapula = round(($prov_rota_Luapula*100)/$allChildren_prov1223_Luapula); 
          $percent_measles_Luapula = round(($prov_measles_Luapula*100)/$allChildren_prov1223_Luapula);
          $percent_fully_Luapula = round(($prov_fully_Luapula*100)/$allChildren_prov1223_Luapula);
        }
        else
        {
          $percent_bcg_Luapula = 0; 
          $percent_opv_Luapula = 0;
          $percent_dtp_Luapula = 0; 
          $percent_pcv_Luapula = 0;
          $percent_rota_Luapula = 0;
          $percent_measles_Luapula = 0;
          $percent_fully_Luapula = 0; 
        }
        
       //end Luapula

        //Lusaka
 
        if($allChildren_prov1223_Lusaka != 0)
        {
          $percent_bcg_Lusaka = round(($prov_bcg_Lusaka*100)/$allChildren_prov1223_Lusaka); 
          $percent_opv_Lusaka = round(($prov_opv_Lusaka*100)/$allChildren_prov1223_Lusaka);
          $percent_dtp_Lusaka = round(($prov_dtp_Lusaka*100)/$allChildren_prov1223_Lusaka); 
          $percent_pcv_Lusaka = round(($prov_pcv_Lusaka*100)/$allChildren_prov1223_Lusaka);
          $percent_rota_Lusaka = round(($prov_rota_Lusaka*100)/$allChildren_prov1223_Lusaka);
          $percent_measles_Lusaka = round(($prov_measles_Lusaka*100)/$allChildren_prov1223_Lusaka);
          $percent_fully_Lusaka = round(($prov_fully_Lusaka*100)/$allChildren_prov1223_Lusaka); 
        }
        else
        {
          $percent_bcg_Lusaka = 0; 
          $percent_opv_Lusaka = 0;
          $percent_dtp_Lusaka = 0; 
          $percent_pcv_Lusaka = 0;
          $percent_rota_Lusaka = 0;
          $percent_measles_Lusaka = 0;
          $percent_fully_Lusaka = 0; 
        }
        
       //end Lusaka

        //Muchinga
         
        if($allChildren_prov1223_Muchinga != 0)
        {
          $percent_bcg_Muchinga = round(($prov_bcg_Muchinga*100)/$allChildren_prov1223_Muchinga); 
          $percent_opv_Muchinga = round(($prov_opv_Muchinga*100)/$allChildren_prov1223_Muchinga);
          $percent_dtp_Muchinga = round(($prov_dtp_Muchinga*100)/$allChildren_prov1223_Muchinga); 
          $percent_pcv_Muchinga = round(($prov_pcv_Muchinga*100)/$allChildren_prov1223_Muchinga);
          $percent_rota_Muchinga = round(($prov_rota_Muchinga*100)/$allChildren_prov1223_Muchinga); 
          $percent_measles_Muchinga = round(($prov_measles_Muchinga*100)/$allChildren_prov1223_Muchinga);
          $percent_fully_Muchinga = round(($prov_fully_Muchinga*100)/$allChildren_prov1223_Muchinga);
        }
        else
        {
          $percent_bcg_Muchinga = 0; 
          $percent_opv_Muchinga = 0;
          $percent_dtp_Muchinga = 0; 
          $percent_pcv_Muchinga = 0;
          $percent_rota_Muchinga = 0;
          $percent_measles_Muchinga = 0;
          $percent_fully_Muchinga = 0; 
        }
        
       //end Muchinga


        //NorthWestern
        
        if($allChildren_prov1223_NorthWestern != 0)
        {
          $percent_bcg_NorthWestern = round(($prov_bcg_NorthWestern*100)/$allChildren_prov1223_NorthWestern); 
          $percent_opv_NorthWestern = round(($prov_opv_NorthWestern*100)/$allChildren_prov1223_NorthWestern);
          $percent_dtp_NorthWestern = round(($prov_dtp_NorthWestern*100)/$allChildren_prov1223_NorthWestern); 
          $percent_pcv_NorthWestern = round(($prov_pcv_NorthWestern*100)/$allChildren_prov1223_NorthWestern);
          $percent_rota_NorthWestern = round(($prov_rota_NorthWestern*100)/$allChildren_prov1223_NorthWestern);
          $percent_measles_NorthWestern = round(($prov_measles_NorthWestern*100)/$allChildren_prov1223_NorthWestern);
          $percent_fully_NorthWestern = round(($prov_fully_NorthWestern*100)/$allChildren_prov1223_NorthWestern); 
        }
        else
        {
          $percent_bcg_NorthWestern = 0; 
          $percent_opv_NorthWestern = 0;
          $percent_dtp_NorthWestern = 0; 
          $percent_pcv_NorthWestern = 0;
          $percent_rota_NorthWestern = 0;
          $percent_measles_NorthWestern = 0;
          $percent_fully_NorthWestern = 0;
        }
      
       //end NorthWestern

       //Northern
        
        if($allChildren_prov1223_Northern != 0)
        {
          $percent_bcg_Northern = round(($prov_bcg_Northern*100)/$allChildren_prov1223_Northern); 
          $percent_opv_Northern = round(($prov_opv_Northern*100)/$allChildren_prov1223_Northern);
          $percent_dtp_Northern = round(($prov_dtp_Northern*100)/$allChildren_prov1223_Northern); 
          $percent_pcv_Northern = round(($prov_pcv_Northern*100)/$allChildren_prov1223_Northern);
          $percent_rota_Northern = round(($prov_rota_Northern*100)/$allChildren_prov1223_Northern); 
          $percent_measles_Northern = round(($prov_measles_Northern*100)/$allChildren_prov1223_Northern);
          $percent_fully_Northern = round(($prov_fully_Northern*100)/$allChildren_prov1223_Northern);
        }
        else
        {
          $percent_bcg_Northern = 0; 
          $percent_opv_Northern = 0;
          $percent_dtp_Northern = 0; 
          $percent_pcv_Northern = 0;
          $percent_rota_Northern = 0;
          $percent_measles_Northern = 0;
          $percent_fully_Northern = 0; 
        }
       //end Northern

        //Western
        
        if($allChildren_prov1223_Western != 0)
        {
          $percent_bcg_Western = round(($prov_bcg_Western*100)/$allChildren_prov1223_Western); 
          $percent_opv_Western = round(($prov_opv_Western*100)/$allChildren_prov1223_Western);
          $percent_dtp_Western = round(($prov_dtp_Western*100)/$allChildren_prov1223_Western); 
          $percent_pcv_Western = round(($prov_pcv_Western*100)/$allChildren_prov1223_Western);
          $percent_rota_Western = round(($prov_rota_Western*100)/$allChildren_prov1223_Western);
          $percent_measles_Western = round(($prov_measles_Western*100)/$allChildren_prov1223_Western);
          $percent_fully_Western = round(($prov_fully_Western*100)/$allChildren_prov1223_Western); 
        }
        else
        {
          $percent_bcg_Western = 0; 
          $percent_opv_Western = 0;
          $percent_dtp_Western = 0; 
          $percent_pcv_Western = 0;
          $percent_rota_Western = 0;
          $percent_measles_Western = 0;
          $percent_fully_Western = 0;
        }
         
       //end Western
       
        $donnees_southern = array( 
                'province'=>'Southern','fully'=>$percent_fully,
                'bcg'=>$percent_bcg,'opv'=>$percent_opv,
                'dtp'=>$percent_dtp,'pcv'=>$percent_pcv,
                'rota'=>$percent_rota,'measles'=>$percent_measles,
                'all'=>$allChildren_prov,'children_1823'=>$allChildren_prov1823,
                'children_023'=>$allChildren_prov023,
                'children_1223'=>$allChildren_prov1223,'children_011'=>$allChildren_prov011,
                'nbrbcg'=>$prov_bcg,'nbropv'=>$prov_opv,
                'nbrdtp'=>$prov_dtp,'nbrpcv'=>$prov_pcv,
                'nbrrota'=>$prov_rota,'nbrmeasles'=>$prov_measles
          ); 
           $donnees_central = array( 
                'province'=>'Central','fully'=>$percent_fully_Central,
                'bcg'=>$percent_bcg_Central,'opv'=>$percent_opv_Central,
                'dtp'=>$percent_dtp_Central,'pcv'=>$percent_pcv_Central,
                'rota'=>$percent_rota_Central,'measles'=>$percent_measles_Central,
                'all'=>$allChildren_prov_Central,'children_1823'=>$allChildren_prov1823_Central,
                'children_023'=>$allChildren_prov023_Central,
                'children_1223'=>$allChildren_prov1223_Central,'children_011'=>$allChildren_prov011_Central,
                'nbrbcg'=>$prov_bcg_Central,'nbropv'=>$prov_opv_Central,
                'nbrdtp'=>$prov_dtp_Central,'nbrpcv'=>$prov_pcv_Central,
                'nbrrota'=>$prov_rota_Central,'nbrmeasles'=>$prov_measles_Central
          ); 
           $donnees_copperbelt = array( 
                'province'=>'Copperbelt','fully'=>$percent_fully_Copperbelt,
                'bcg'=>$percent_bcg_Copperbelt,'opv'=>$percent_opv_Copperbelt,
                'dtp'=>$percent_dtp_Copperbelt,'pcv'=>$percent_pcv_Copperbelt,
                'rota'=>$percent_rota_Copperbelt,'measles'=>$percent_measles_Copperbelt,
                'all'=>$allChildren_prov_Copperbelt,'children_1823'=>$allChildren_prov1823_Copperbelt,
                'children_023'=>$allChildren_prov023_Copperbelt,
                'children_1223'=>$allChildren_prov1223_Copperbelt,'children_011'=>$allChildren_prov011_Copperbelt,
                'nbrbcg'=>$prov_bcg_Copperbelt,'nbropv'=>$prov_opv_Copperbelt,
                'nbrdtp'=>$prov_dtp_Copperbelt,'nbrpcv'=>$prov_pcv_Copperbelt,
                'nbrrota'=>$prov_rota_Copperbelt,'nbrmeasles'=>$prov_measles_Copperbelt
          ); 
           $donnees_eastern = array( 
                'province'=>'Eastern','fully'=>$percent_fully_Eastern,
                'bcg'=>$percent_bcg_Eastern,'opv'=>$percent_opv_Eastern,
                'dtp'=>$percent_dtp_Eastern,'pcv'=>$percent_pcv_Eastern,
                'rota'=>$percent_rota_Eastern,'measles'=>$percent_measles_Eastern,
                'all'=>$allChildren_prov_Eastern,'children_1823'=>$allChildren_prov1823_Eastern,
                'children_023'=>$allChildren_prov023_Eastern,
                'children_1223'=>$allChildren_prov1223_Eastern,'children_011'=>$allChildren_prov011_Eastern,
                'nbrbcg'=>$prov_bcg_Eastern,'nbropv'=>$prov_opv_Eastern,
                'nbrdtp'=>$prov_dtp_Eastern,'nbrpcv'=>$prov_pcv_Eastern,
                'nbrrota'=>$prov_rota_Eastern,'nbrmeasles'=>$prov_measles_Eastern
          ); 
            $donnees_luapula = array( 
                'province'=>'Luapula','fully'=>$percent_fully_Luapula,
                'bcg'=>$percent_bcg_Luapula,'opv'=>$percent_opv_Luapula,
                'dtp'=>$percent_dtp_Luapula,'pcv'=>$percent_pcv_Luapula,
                'rota'=>$percent_rota_Luapula,'measles'=>$percent_measles_Luapula,
                'all'=>$allChildren_prov_Luapula,'children_1823'=>$allChildren_prov1823_Luapula,
                'children_023'=>$allChildren_prov023_Luapula,
                'children_1223'=>$allChildren_prov1223_Luapula,'children_011'=>$allChildren_prov011_Luapula,
                'nbrbcg'=>$prov_bcg_Luapula,'nbropv'=>$prov_opv_Luapula,
                'nbrdtp'=>$prov_dtp_Luapula,'nbrpcv'=>$prov_pcv_Luapula,
                'nbrrota'=>$prov_rota_Luapula,'nbrmeasles'=>$prov_measles_Luapula
          ); 

            $donnees_lusaka = array( 
                'province'=>'Lusaka','fully'=>$percent_fully_Lusaka,
                'bcg'=>$percent_bcg_Lusaka,'opv'=>$percent_opv_Lusaka,
                'dtp'=>$percent_dtp_Lusaka,'pcv'=>$percent_pcv_Lusaka,
                'rota'=>$percent_rota_Lusaka,'measles'=>$percent_measles_Lusaka,
                'all'=>$allChildren_prov_Lusaka,'children_1823'=>$allChildren_prov1823_Lusaka,
                'children_023'=>$allChildren_prov023_Lusaka,
                'children_1223'=>$allChildren_prov1223_Lusaka,'children_011'=>$allChildren_prov011_Lusaka,
                'nbrbcg'=>$prov_bcg_Lusaka,'nbropv'=>$prov_opv_Lusaka,
                'nbrdtp'=>$prov_dtp_Lusaka,'nbrpcv'=>$prov_pcv_Lusaka,
                'nbrrota'=>$prov_rota_Lusaka,'nbrmeasles'=>$prov_measles_Lusaka
          ); 

            $donnees_muchinga = array( 
                'province'=>'Muchinga','fully'=>$percent_fully_Muchinga,
                'bcg'=>$percent_bcg_Muchinga,'opv'=>$percent_opv_Muchinga,
                'dtp'=>$percent_dtp_Muchinga,'pcv'=>$percent_pcv_Muchinga,
                'rota'=>$percent_rota_Muchinga,'measles'=>$percent_measles_Muchinga,
                'all'=>$allChildren_prov_Muchinga,'children_1823'=>$allChildren_prov1823_Muchinga,
                'children_023'=>$allChildren_prov023_Muchinga,
                'children_1223'=>$allChildren_prov1223_Muchinga,'children_011'=>$allChildren_prov011_Muchinga,
                'nbrbcg'=>$prov_bcg_Muchinga,'nbropv'=>$prov_opv_Muchinga,
                'nbrdtp'=>$prov_dtp_Muchinga,'nbrpcv'=>$prov_pcv_Muchinga,
                'nbrrota'=>$prov_rota_Muchinga,'nbrmeasles'=>$prov_measles_Muchinga 
          ); 

             $donnees_northWestern = array( 
                'province'=>'North-Western','fully'=>$percent_fully_NorthWestern,
                'bcg'=>$percent_bcg_NorthWestern,'opv'=>$percent_opv_NorthWestern,
                'dtp'=>$percent_dtp_NorthWestern,'pcv'=>$percent_pcv_NorthWestern,
                'rota'=>$percent_rota_NorthWestern,'measles'=>$percent_measles_NorthWestern,
                'all'=>$allChildren_prov_NorthWestern,'children_1823'=>$allChildren_prov1823_NorthWestern,'children_023'=>$allChildren_prov023_NorthWestern,
                'children_1223'=>$allChildren_prov1223_NorthWestern,'children_011'=>$allChildren_prov011_NorthWestern,
                'nbrbcg'=>$prov_bcg_NorthWestern,'nbropv'=>$prov_opv_NorthWestern,
                'nbrdtp'=>$prov_dtp_NorthWestern,'nbrpcv'=>$prov_pcv_NorthWestern,
                'nbrrota'=>$prov_rota_NorthWestern,'nbrmeasles'=>$prov_measles_NorthWestern
          ); 

              $donnees_northern = array( 
                'province'=>'Northern','fully'=>$percent_fully_Northern,
                'bcg'=>$percent_bcg_Northern,'opv'=>$percent_opv_Northern,
                'dtp'=>$percent_dtp_Northern,'pcv'=>$percent_pcv_Northern,
                'rota'=>$percent_rota_Northern,'measles'=>$percent_measles_Northern,
                'all'=>$allChildren_prov_Northern,'children_1823'=>$allChildren_prov1823_Northern,
                'children_023'=>$allChildren_prov023_Northern,
                'children_1223'=>$allChildren_prov1223_Northern,'children_011'=>$allChildren_prov011_Northern,
                'nbrbcg'=>$prov_bcg_Northern,'nbropv'=>$prov_opv_Northern,
                'nbrdtp'=>$prov_dtp_Northern,'nbrpcv'=>$prov_pcv_Northern,
                'nbrrota'=>$prov_rota_Northern,'nbrmeasles'=>$prov_measles_Northern
          ); 

               $donnees_western = array( 
                'province'=>'Western','fully'=>$percent_fully_Western,
                'bcg'=>$percent_bcg_Western,'opv'=>$percent_opv_Western,
                'dtp'=>$percent_dtp_Western,'pcv'=>$percent_pcv_Western,
                'rota'=>$percent_rota_Western,'measles'=>$percent_measles_Western,
                'all'=>$allChildren_prov_Western,'children_1823'=>$allChildren_prov1823_Western,
                'children_023'=>$allChildren_prov023_Western,
                'children_1223'=>$allChildren_prov1223_Western,'children_011'=>$allChildren_prov011_Western,
                'nbrbcg'=>$prov_bcg_Western,'nbropv'=>$prov_opv_Western,
                'nbrdtp'=>$prov_dtp_Western,'nbrpcv'=>$prov_pcv_Western,
                'nbrrota'=>$prov_rota_Western,'nbrmeasles'=>$prov_measles_Western
          ); 

          $donnees= array(
                $donnees_central,
                $donnees_copperbelt,
                $donnees_eastern,
                $donnees_luapula,
                $donnees_lusaka,
                $donnees_muchinga,
                $donnees_northWestern,
                $donnees_northern,
                $donnees_southern,
                $donnees_western
          );
                
          
      return $donnees;
    } 
}
