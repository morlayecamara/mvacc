<?php

namespace blog\Http\Controllers\Facilitys;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Http\Controllers\Controller;
use blog\Percent; 
use blog\User;
use Auth; 

class FacilitysController extends Controller
{
	
      
    public function index()
    {
    	 //$childrens = Children::all(); 
       $roles = Auth::user()->roles; 
       if($roles == 'admin')
       {
         $provinces = Percent::select('province')
                    ->groupBy('province') 
                    ->get(); 
       
          return view('facilitys.index')->with('provinces',$provinces);
       }
       else
       {
          return redirect('/');
       }
      
    }

    public function facility(Request $request)
    {
        $province =  $request->input('province');
        $district =  $request->input('district'); 
        $facilitys = Percent::select('health_facility')
                ->where('province', '=', $province)
                ->where('district', '=', $district) 
                ->groupBy('health_facility') 
                ->get(); 
       if (is_null($facilitys)) {
           return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
       }
        return $facilitys;
    } 

     public function pagefacility(Request $request)
    {
        $roles = Auth::user()->roles;
        if($roles == 'admin' or $roles == 'viewer-province' or $roles == 'viewer-district' or $roles == 'viewer-facility')
        {
           $provinces = Percent::select('province')
                    ->groupBy('province') 
                    ->get(); 
        
       
          return view('facilitys.facility')->with('provinces',$provinces);
        }
        else
        {
            return redirect('/');
        }
       
    } 
}