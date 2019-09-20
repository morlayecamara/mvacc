<?php

namespace blog\Http\Controllers\Vaccine;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Http\Controllers\Controller;
use blog\User;
use Auth; 

class MeaslesController extends Controller
{
	 
    public function index()
	{
		$roles = Auth::user()->roles; 
		if($roles == 'admin')
        {
        	return view('vaccine.measles');
        }
        else
        {
            return redirect('/');
        } 
	}
}
