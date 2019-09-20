<?php

namespace blog\Http\Controllers\Provinces;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Percent; 
use blog\User;
use Auth; 
use blog\Http\Controllers\Controller;

class ProvincesController extends Controller
{
	 
      
    public function index()
    {
        $roles = Auth::user()->roles; 
        if($roles == 'admin')
        {
            return view('provinces.index');
        }
        else
        {
            return redirect('/');
        }
    	
    }

    public function province()
    {
        $roles = Auth::user()->roles; 

        if($roles == 'admin' or $roles == 'viewer-province')
        {
            $provinces = Percent::select('province')
                    ->groupBy('province') 
                    ->get(); 
            return view('provinces.province')->with('provinces',$provinces);
        }
        else
        {
            return redirect('/');
        } 
    }
}
