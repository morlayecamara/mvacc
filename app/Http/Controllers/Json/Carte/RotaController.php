<?php

namespace blog\Http\Controllers\Json\Carte;

use Illuminate\Http\Request;
use blog\Percent;  
use blog\Http\Requests;
use blog\Http\Controllers\Controller;

class RotaController extends Controller
{
    public function getData(Request $request)
    {
         
       //$percents = Percent::all();
       $percents = Percent::select('uuid', 'age',
                                  'sex', 'province', 'district',
                                  'health_facility', 'location', 'chw_phone',
                                  'mother_phone', 'zone', 'bcg',
                                  'opv', 'dtp', 'pcv', 'rota', 'measles','fully')   
                                  ->whereBetween('age', [0, 23]) 
                                  ->get(); 
       if (is_null($percents)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
       }
       $allpercent_18_23 = 0;
       $central_fully = 0;
       $copperbelt_fully = 0;
       $eastern_fully = 0;
       $luapula_fully = 0;
       $lusaka_fully = 0;
       $muchinga_fully = 0;
       $north_western_fully = 0;
       $northern_fully = 0;
       $southern_fully = 0;
       $western_fully = 0; 
       foreach ($percents as $child) {
         $age = $child->age;
         if($age >= 0 and $age < 24)
         { 
           
            $result= $child->rota;
           
            if($age >= 12 and $age < 24)
            {
            	$allpercent_18_23 = $allpercent_18_23 + 1;
            	if($result == 2)
            	{
            	  if($child->province == 'Central')
            	  {
            	  	 $central_fully = $central_fully + 1;  
            	  } 
            	  if($child->province == 'Copperbelt')
            	  {
            	  	 $copperbelt_fully = $copperbelt_fully + 1;  
            	  } 
            	  if($child->province == 'Eastern')
            	  {
            	  	 $eastern_fully = $eastern_fully + 1;  
            	  } 
            	  if($child->province == 'Luapula')
            	  {
            	  	 $luapula_fully = $luapula_fully + 1; 
            	  }
            	  if($child->province == 'Lusaka')
            	  {
            	  	 $lusaka_fully = $lusaka_fully + 1;  
            	  }  
            	  if($child->province == 'Muchinga')
            	  {
            	  	 $muchinga_fully = $muchinga_fully + 1;  
            	  }
            	  if($child->province == 'North-Western')
            	  {
            	  	 $north_western_fully = $north_western_fully + 1;  
            	  }  
            	  if($child->province == 'Northern')
            	  {
            	  	 $northern_fully = $northern_fully + 1; 
            	  }
            	  if($child->province == 'Southern')
            	  {
            	  	 $southern_fully = $southern_fully + 1; 
            	  } 
            	  if($child->province == 'Western')
            	  {
            	  	 $western_fully = $western_fully + 1;  
            	  }   
            	}
            }
       }
     }
       if($allpercent_18_23 != 0)
       {
          $zmce = round(($central_fully*100)/$allpercent_18_23);
          $zmco = round(($copperbelt_fully*100)/$allpercent_18_23);
          $zmea = round(($eastern_fully*100)/$allpercent_18_23);
          $zmlp = round(($luapula_fully*100)/$allpercent_18_23);
          $zmls = round(($lusaka_fully*100)/$allpercent_18_23);
          $zmmu = round(($muchinga_fully*100)/$allpercent_18_23);
          $zmnw = round(($north_western_fully*100)/$allpercent_18_23);
          $zmno = round(($northern_fully*100)/$allpercent_18_23);
          $zmso = round(($southern_fully*100)/$allpercent_18_23);
          $zmwe = round(($western_fully*100)/$allpercent_18_23);
       }else{
          $zmce = 0;
          $zmco = 0;
          $zmea = 0;
          $zmlp = 0;
          $zmls = 0;
          $zmmu = 0;
          $zmnw = 0;
          $zmno = 0;
          $zmso = 0;
          $zmwe = 0;
       }
        
        $donnees = array(   
              ['zm-ce',$zmce],
              ['zm-co',$zmco],
              ['zm-ea',$zmea],
              ['zm-lp',$zmlp],
              ['zm-ls',$zmls],
              ['zm-mu',$zmmu],
              ['zm-nw',$zmnw],
              ['zm-no',$zmno],
              ['zm-so',$zmso],
              ['zm-we',$zmwe] 
          );  
       return $donnees;
    } 
}
