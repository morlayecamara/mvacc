<?php

namespace blog\Http\Controllers\Districts;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Http\Controllers\Controller;
use blog\Percent; 
use blog\User;
use Auth; 

class DistrictsController extends Controller
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
        
       
          return view('districts.index')->with('provinces',$provinces);
       }
       else
       {
          return redirect('/');
       }
    }

    public function district(Request $request)
    {
        $province =  $request->input('province');
        $districts = Percent::select('district')
                ->where('province', '=', $province)
                ->groupBy('district') 
                ->get(); 
       if (is_null($districts)) {
           return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
       }
        return $districts;
    } 

    public function pagedistrict(Request $request)
    {
        $roles = Auth::user()->roles;
        if($roles == 'admin' or $roles == 'viewer-province' or $roles == 'viewer-district')
        {
           $provinces = Percent::select('province')
                    ->groupBy('province') 
                    ->get(); 
        
       
          return view('districts.district')->with('provinces',$provinces);
        }
        else
        {
            return redirect('/');
        }
       
    } 
}