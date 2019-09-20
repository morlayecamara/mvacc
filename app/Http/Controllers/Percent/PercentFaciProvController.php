<?php

namespace blog\Http\Controllers\Percent;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Percent;  
use blog\Http\Controllers\Controller; 

class PercentFaciProvController extends Controller
{

     

    public function getData()
    {

      
        $paramchildren = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully')
                                  ->orderBy('health_facility', 'asc')
                                  ->whereBetween('age', [0, 23]) 
                                  ->get(); 

        $current_facility=null;
        $arry_facility = array();

        if (is_null($paramchildren)) {
           return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        } 
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
         foreach ($paramchildren as $child) {
            $age = $child->age;
            $bcg = $child->bcg;
            $opv = $child->opv;
            $dtp = $child->dtp;
            $pcv = $child->pcv;
            $rota = $child->rota;
            $measles = $child->measles;
            $fully = $child->fully;
            $paramprovince = $child->province; 
            $paramdistrict = $child->district; 
            $paramfacility = $child->health_facility; 

            if($current_facility!=$paramfacility) {
                $current_facility=$paramfacility;
                array_push($arry_facility, $current_facility); 
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

            } 

            if($age >= 0 and $age < 24)
            { 
             
            if($child->province == $paramprovince and $child->district == $paramdistrict and $child->health_facility == $paramfacility)
            {  
              $allChildren_prov = $allChildren_prov + 1; 
            } 
            
            if($age >= 0 and $age < 12)
            {
               if($child->province == $paramprovince and $child->district == $paramdistrict and $child->health_facility == $paramfacility)
                {  
                  $allChildren_prov011 = $allChildren_prov011 + 1; 
                } 
            }//end if $age >= 0 and $age < 12
            if($age >= 0 and $age < 24)
            {
               if($child->province == $paramprovince and $child->district == $paramdistrict and $child->health_facility == $paramfacility)
               {  
                  $allChildren_prov023 = $allChildren_prov023 + 1; 
               } 
            }//end if $age >= 0 and $age < 24
            if($age >= 12 and $age < 24)
            {
              if($child->province == $paramprovince and $child->district == $paramdistrict and $child->health_facility == $paramfacility)
              {  
                  $allChildren_prov1223 = $allChildren_prov1223 + 1; 
                  if($bcg == 1)
                  {
                    $prov_bcg = $prov_bcg + 1;
                  } 
                  if($opv >= 3)
                  {
                    $prov_opv = $prov_opv+  1;
                  }
                  if($opv == 3)
                  {
                    $prov_opv = $prov_opv + 1;
                  } 
                  if($dtp == 3)
                  {
                    $prov_dtp = $prov_dtp + 1;
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
            }//end if $age >= 12 and $age < 24
            if($age >= 12 and $age < 24)
            {
              if($child->province == $paramprovince and $child->district == $paramdistrict and $child->health_facility == $paramfacility)
                {  
                  $allChildren_prov1823 = $allChildren_prov1823 + 1; 
                  if($fully == 1)
                  {
                    $prov_fully = $prov_fully + 1;
                  } 
                } 
            }//end if $age >= 18 and $age < 24
         
            }//end if $age >= 0 and $age < 24

              
              if($allChildren_prov1223 != 0)
              {
                $percent_bcg = round(($prov_bcg*100)/$allChildren_prov1223); 
                $percent_opv = round(($prov_opv*100)/$allChildren_prov1223);
                $percent_dtp = round(($prov_dtp*100)/$allChildren_prov1223); 
                $percent_pcv = round(($prov_pcv*100)/$allChildren_prov1223);
                $percent_rota = round(($prov_rota*100)/$allChildren_prov1223);
                $percent_measles = round(($prov_measles*100)/$allChildren_prov1823);
                $percent_fully = round(($prov_fully*100)/$allChildren_prov1823); 
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

              ${$current_facility} = array( 
                'facility'=>$paramfacility,'province'=>$paramprovince,'district'=>$paramdistrict,'fully'=>$percent_fully,
                'bcg'=>$percent_bcg,'opv'=>$percent_opv,
                'dtp'=>$percent_dtp,'pcv'=>$percent_pcv,
                'rota'=>$percent_rota,'measles'=>$percent_measles,
                'all'=>$allChildren_prov,'children_1823'=>$allChildren_prov1823,
                'children_023'=>$allChildren_prov023,
                'children_1223'=>$allChildren_prov1223,'children_011'=>$allChildren_prov011 
          ); 

        }//end for foreach $childrens
     
       
          foreach ($arry_facility as $arry_faci) {
            $donnees[] = ${$arry_faci};
        }

       return $donnees; 
    } 
}
