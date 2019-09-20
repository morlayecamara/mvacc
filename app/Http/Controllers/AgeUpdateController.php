<?php

namespace blog\Http\Controllers;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Percent; 
use blog\Children; 
use blog\Http\Controllers\Controller; 
use blog\Http\Controllers\AgeController;
use DB;

class AgeUpdateController extends Controller
{ 

    public function updateChildren()
    { 

        $requests = Children::select('uuid', 'age', 'dob')    
                                  ->whereBetween('age', [18, 23]) 
                                  ->get();  

        foreach ($requests as $request) {
           $uuid = $request->uuid; 
           $dob = $request->dob;
           $age = (new AgeController)->getAge($dob); 
           DB::table('zambia_children')
                     ->where('uuid', $uuid)
                     ->update([
                      'age' => $age
           ]);

        }  
       
    } 

    public function updateChildrenOne()
    { 

        $requests = Children::select('uuid', 'age', 'dob')    
                                  ->whereBetween('age', [0, 7]) 
                                  ->get();  

        foreach ($requests as $request) {
           $uuid = $request->uuid; 
           $dob = $request->dob;
           $age = (new AgeController)->getAge($dob); 
           DB::table('zambia_children')
                     ->where('uuid', $uuid)
                     ->update([
                      'age' => $age
           ]);

        }  
       
    } 

    public function updateChildrenTwo()
    { 

        $requests = Children::select('uuid', 'age', 'dob')    
                                  ->whereBetween('age', [7, 14]) 
                                  ->get();  

        foreach ($requests as $request) {
           $uuid = $request->uuid; 
           $dob = $request->dob;
           $age = (new AgeController)->getAge($dob); 
           DB::table('zambia_children')
                     ->where('uuid', $uuid)
                     ->update([
                      'age' => $age
           ]);

        }  
       
    } 

    public function updateChildrenThree()
    { 

        $requests = Children::select('uuid', 'age', 'dob')    
                                  ->whereBetween('age', [14, 23]) 
                                  ->get();  

        foreach ($requests as $request) {
           $uuid = $request->uuid; 
           $dob = $request->dob;
           $age = (new AgeController)->getAge($dob); 
           DB::table('zambia_children')
                     ->where('uuid', $uuid)
                     ->update([
                      'age' => $age
           ]);

        }  
       
    } 

    public function updatePercent()
    { 

        $requests = Percent::select('uuid', 'age', 'dob')    
                                  ->whereBetween('age', [18, 23]) 
                                  ->get();  

        foreach ($requests as $request) {
           $uuid = $request->uuid; 
           $dob = $request->dob;
           $age = (new AgeController)->getAge($dob); 
           DB::table('zambia_percent')
                     ->where('uuid', $uuid)
                     ->update([
                      'age' => $age
           ]);

        }  
       
    } 

    public function updatePercentOne()
    { 

        $requests = Percent::select('uuid', 'age', 'dob')    
                                  ->whereBetween('age', [0, 7]) 
                                  ->get();  

        foreach ($requests as $request) {
           $uuid = $request->uuid; 
           $dob = $request->dob;
           $age = (new AgeController)->getAge($dob); 
           DB::table('zambia_percent')
                     ->where('uuid', $uuid)
                     ->update([
                      'age' => $age
           ]);

        }  
       
    } 

    public function updatePercentTwo()
    { 

        $requests = Percent::select('uuid', 'age', 'dob')    
                                  ->whereBetween('age', [7, 14]) 
                                  ->get();  

        foreach ($requests as $request) {
           $uuid = $request->uuid; 
           $dob = $request->dob;
           $age = (new AgeController)->getAge($dob); 
           DB::table('zambia_percent')
                     ->where('uuid', $uuid)
                     ->update([
                      'age' => $age
           ]);

        }  
       
    } 

    public function updatePercentThree()
    { 

        $requests = Percent::select('uuid', 'age', 'dob')    
                                  ->whereBetween('age', [14, 23]) 
                                  ->get();  

        foreach ($requests as $request) {
           $uuid = $request->uuid; 
           $dob = $request->dob;
        
           $age = (new AgeController)->getAge($dob); 
           DB::table('zambia_percent')
                     ->where('uuid', $uuid)
                     ->update([
                      'age' => $age
           ]);

        }  
       
    } 
}