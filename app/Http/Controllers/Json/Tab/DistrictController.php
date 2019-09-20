<?php

namespace blog\Http\Controllers\Json\Tab;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Children;  
use blog\Http\Controllers\Controller;
use blog\Http\Controllers\Percent\PercentDistController; 
use blog\Http\Controllers\Percent\PercentDistProvController; 

class DistrictController extends Controller
{
   
      
    public function getData(Request $request)
    { 
         
       $province =  $request->input('province');

       if($province == '')
       {
           $data = (new PercentDistProvController)->getData();   
       }
       else
       {
           $data = (new PercentDistController)->getData($province);  
       } 

       return $data;
    } 
}
