<?php

namespace blog\Http\Controllers\Zones;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Http\Controllers\Controller;
use blog\Percent; 
use blog\User;
use Auth; 

class ZonesController extends Controller
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
       
          return view('zones.index')->with('provinces',$provinces);
       }
       else
       {
          return redirect('/');
       }
    }

    public function zone(Request $request)
    {
        $province =  $request->input('province');
        $district =  $request->input('district');
        $facility =  $request->input('facility');
        $zones = Percent::select('zone')
                ->where('province', '=', $province)
                ->where('district', '=', $district)
                ->where('health_facility', '=', $facility)
                ->groupBy('zone') 
                ->get(); 
       if (is_null($zones)) {
           return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
       }
        return $zones;
    } 
     public function pagezone(Request $request)
    {
        $roles = Auth::user()->roles;
        if($roles == 'admin' or $roles == 'viewer-province' or $roles == 'viewer-district' or $roles == 'viewer-facility' or $roles == 'viewer-zone')
        {
           $provinces = Percent::select('province')
                    ->groupBy('province') 
                    ->get(); 
        
       
          return view('zones.zone')->with('provinces',$provinces);
        }
        else
        {
            return redirect('/');
        }
       
    } 
}