<?php

namespace blog\Http\Controllers\Json\Carte;

use Illuminate\Http\Request;
use blog\Percent;  
use blog\Http\Requests;
use blog\Http\Controllers\Controller;

class OverviewController extends Controller
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
       $allpercent_12_23 = 0;
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

       $central_all = 0;
       $copperbelt_all = 0;
       $eastern_all = 0;
       $luapula_all = 0;
       $lusaka_all = 0;
       $muchinga_all = 0;
       $north_western_all = 0;
       $northern_all = 0;
       $southern_all = 0;
       $western_all = 0; 
       foreach ($percents as $child) {
         $age = $child->age;
         if($age >= 0 and $age < 24)
         { 
           
            $result= $child->fully;
           
            if($age >= 12 and $age < 24)
            {
            	  $allpercent_12_23 = $allpercent_12_23 + 1;

                if($child->province == 'Central')
                {
                   $central_all = $central_all + 1;  
                } 
                if($child->province == 'Copperbelt')
                {
                   $copperbelt_all = $copperbelt_all + 1;  
                } 
                if($child->province == 'Eastern')
                {
                   $eastern_all = $eastern_all + 1;  
                } 
                if($child->province == 'Luapula')
                {
                   $luapula_all = $luapula_all + 1; 
                }
                if($child->province == 'Lusaka')
                {
                   $lusaka_all = $lusaka_all + 1;  
                }  
                if($child->province == 'Muchinga')
                {
                   $muchinga_all = $muchinga_all + 1;  
                }
                if($child->province == 'North-Western')
                {
                   $north_western_all = $north_western_all + 1;  
                }  
                if($child->province == 'Northern')
                {
                   $northern_all = $northern_all + 1; 
                }
                if($child->province == 'Southern')
                {
                   $southern_all = $southern_all + 1; 
                } 
                if($child->province == 'Western')
                {
                   $western_all = $western_all + 1;  
                }  

            	if($result == 1)
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
       if($central_all != 0)
       {
          $zmce = round(($central_fully*100)/$central_all); 
       }else{
          $zmce = 0; 
       }

       if($copperbelt_all != 0)
       { 
          $zmco = round(($copperbelt_fully*100)/$copperbelt_all); 
       }else{ 
          $zmco = 0; 
       }

       if($eastern_all != 0)
       {  
          $zmea = round(($eastern_fully*100)/$eastern_all); 
       }else{  
          $zmea = 0; 
       }

        if($luapula_all != 0)
       {   
          $zmlp = round(($luapula_fully*100)/$luapula_all); 
       }else{   
          $zmlp = 0; 
       }

        if($lusaka_all != 0)
       {  
          $zmls = round(($lusaka_fully*100)/$lusaka_all); 
       }else{  
          $zmls = 0; 
          $zmwe = 0;
       } 

        if($muchinga_all != 0)
       {   
          $zmmu = round(($muchinga_fully*100)/$muchinga_all); 
       }else{   
          $zmmu = 0; 
       }

      if($north_western_all != 0)
       {  
          $zmnw = round(($north_western_fully*100)/$north_western_all); 
       }else{  
          $zmnw = 0; 
       }

        if($northern_all != 0)
       {   
          $zmno = round(($northern_fully*100)/$northern_all); 
       }else{   
          $zmno = 0; 
       }

       if($southern_all != 0)
       {   
          $zmso = round(($southern_fully*100)/$southern_all); 
       }else{   
          $zmso = 0; 
       }

       if($western_all != 0)
       {   
          $zmwe = round(($western_fully*100)/$western_all);
       }else{ 
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
