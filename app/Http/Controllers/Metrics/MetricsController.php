<?php

namespace blog\Http\Controllers\Metrics;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Http\Controllers\Controller;
use blog\User;
use Auth; 

class MetricsController extends Controller
{ 
      
    public function index()
	{
		 $roles = Auth::user()->roles; 
	     if($roles == 'admin')
	     {
	     	return view('metrics.index');
	     } 
	}

	public function province()
	{
		 $roles = Auth::user()->roles; 
	     if($roles == 'viewer-province')
	     {
	     	return view('metrics.province');
	     } 
	}

	public function district()
	{
		 $roles = Auth::user()->roles; 
	     if($roles == 'viewer-district')
	     {
	     	return view('metrics.district');
	     } 
	}

	public function facility()
	{
		 $roles = Auth::user()->roles; 
	     if($roles == 'viewer-facility')
	     {
	     	return view('metrics.facility');
	     } 
	}

	public function zone()
	{
		 $roles = Auth::user()->roles; 
	     if($roles == 'viewer-zone')
	     {
	     	return view('metrics.zone');
	     }
	}

}
