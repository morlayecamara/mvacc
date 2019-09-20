<?php

namespace blog\Http\Controllers\Metrics;

use Illuminate\Http\Request;
use blog\Http\Controllers\Controller;

use blog\Http\Requests;
use blog\Children; 
use blog\Facility; 
use blog\Chw;
use blog\Vaccine;  
use DB;
use blog\User;
use Auth; 

class BlogController extends Controller
{
    public function blogMetricsFour()
	{
	    $facility = 0;
	    $facilitytot = 0;
	    $district = 0;
	    $districttot = 0;
	    $chw = 0;
	    $chw2 = 0;

	    $roles = Auth::user()->roles;

	    $prov = Auth::user()->province;
	    $dist = Auth::user()->district; 
	    $faci = Auth::user()->facility;
	    $zone     = Auth::user()->zone;


	    if($roles == 'admin')
        {

				$datas = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, health_facility"))  
					    ->groupBy(DB::raw("health_facility")) 
					    ->get();

			    $datas2 = DB::table("zambia_health_facility")
					    ->select(DB::raw("COUNT(*) as value, name"))  
					    ->groupBy(DB::raw("name")) 
					    ->get();

			    $datas3 = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, district"))  
					    ->groupBy(DB::raw("district")) 
					    ->get();

			    $datas4 = DB::table("zambia_district")
					    ->select(DB::raw("COUNT(*) as value, name"))  
					    ->groupBy(DB::raw("name")) 
					    ->get();

				$dataschw = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, chw_phone"))  
					    ->groupBy(DB::raw("chw_phone")) 
					    ->get();

				$dataschw2 = DB::table("zambia_chw")
					    ->select(DB::raw("COUNT(*) as value, chw_phone"))  
					    ->groupBy(DB::raw("chw_phone")) 
					    ->get();
        }

        if($roles == 'viewer-province')
        {
        	
				$datas = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, health_facility")) 
					    ->where('province', '=', $prov) 
					    ->groupBy(DB::raw("health_facility")) 
					    ->get();

			    $datas2 = DB::table("zambia_health_facility")
					    ->select(DB::raw("COUNT(*) as value, name"))  
					    ->where('province', '=', $prov)
					    ->groupBy(DB::raw("name")) 
					    ->get();

			    $datas3 = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, district")) 
					    ->where('province', '=', $prov) 
					    ->groupBy(DB::raw("district")) 
					    ->get();

			    $datas4 = DB::table("zambia_district")
					    ->select(DB::raw("COUNT(*) as value, name")) 
					    ->where('province', '=', $prov) 
					    ->groupBy(DB::raw("name")) 
					    ->get();

				$dataschw = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, chw_phone"))
					    ->where('province', '=', $prov)  
					    ->groupBy(DB::raw("chw_phone")) 
					    ->get();

				$dataschw2 = DB::table("zambia_chw")
					    ->select(DB::raw("COUNT(*) as value, chw_phone")) 
					    ->where('province', '=', $prov) 
					    ->groupBy(DB::raw("chw_phone")) 
					    ->get();
        }

        if($roles == 'viewer-district')
        {
        	
				$datas = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, health_facility")) 
					    ->where('province', '=', $prov)
					    ->where('district', '=', $dist) 
					    ->groupBy(DB::raw("health_facility")) 
					    ->get();

			    $datas2 = DB::table("zambia_health_facility")
					    ->select(DB::raw("COUNT(*) as value, name"))  
					    ->where('province', '=', $prov)
					    ->where('district', '=', $dist)
					    ->groupBy(DB::raw("name")) 
					    ->get();

			    $datas3 = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, district")) 
					    ->where('province', '=', $prov) 
					    ->where('district', '=', $dist)
					    ->groupBy(DB::raw("district")) 
					    ->get();

			    $datas4 = DB::table("zambia_district")
					    ->select(DB::raw("COUNT(*) as value, name")) 
					    ->where('province', '=', $prov) 
					    ->where('name', '=', $dist)
					    ->groupBy(DB::raw("name")) 
					    ->get();

				$dataschw = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, chw_phone"))
					    ->where('province', '=', $prov)  
					    ->where('district', '=', $dist)
					    ->groupBy(DB::raw("chw_phone")) 
					    ->get();

				$dataschw2 = DB::table("zambia_chw")
					    ->select(DB::raw("COUNT(*) as value, chw_phone")) 
					    ->where('province', '=', $prov) 
					    ->where('district', '=', $dist)
					    ->groupBy(DB::raw("chw_phone")) 
					    ->get();
        }

        if($roles == 'viewer-facility')
        {
        	
				$datas = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, health_facility")) 
					    ->where('province', '=', $prov)
					    ->where('district', '=', $dist) 
					    ->where('health_facility', '=', $faci) 
					    ->groupBy(DB::raw("health_facility")) 
					    ->get();

			    $datas2 = DB::table("zambia_health_facility")
					    ->select(DB::raw("COUNT(*) as value, name"))  
					    ->where('province', '=', $prov)
					    ->where('district', '=', $dist)
					    ->where('name', '=', $faci)
					    ->groupBy(DB::raw("name")) 
					    ->get();

			    $datas3 = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, district")) 
					    ->where('province', '=', $prov) 
					    ->where('district', '=', $dist)
					    ->where('health_facility', '=', $faci)
					    ->groupBy(DB::raw("district")) 
					    ->get();

			    $datas4 = DB::table("zambia_district")
					    ->select(DB::raw("COUNT(*) as value, name")) 
					    ->where('province', '=', $prov) 
					    ->where('name', '=', $dist) 
					    ->groupBy(DB::raw("name")) 
					    ->get();

				$dataschw = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, chw_phone"))
					    ->where('province', '=', $prov)  
					    ->where('district', '=', $dist)
					    ->where('health_facility', '=', $faci)
					    ->groupBy(DB::raw("chw_phone")) 
					    ->get();

				$dataschw2 = DB::table("zambia_chw")
					    ->select(DB::raw("COUNT(*) as value, chw_phone")) 
					    ->where('province', '=', $prov) 
					    ->where('district', '=', $dist)
					    ->where('health_facility', '=', $faci)
					    ->groupBy(DB::raw("chw_phone")) 
					    ->get();
        }
        if($roles == 'viewer-zone')
        {
        	
				$datas = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, health_facility")) 
					    ->where('province', '=', $prov)
					    ->where('district', '=', $dist) 
					    ->where('health_facility', '=', $faci) 
					    ->where('zone', '=', $zone) 
					    ->groupBy(DB::raw("health_facility")) 
					    ->get();

			    $datas2 = DB::table("zambia_health_facility")
					    ->select(DB::raw("COUNT(*) as value, name"))  
					    ->where('province', '=', $prov)
					    ->where('district', '=', $dist)
					    ->where('name', '=', $faci) 
					    ->groupBy(DB::raw("name")) 
					    ->get();

			    $datas3 = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, district")) 
					    ->where('province', '=', $prov) 
					    ->where('district', '=', $dist)
					    ->where('health_facility', '=', $faci)
					    ->where('zone', '=', $zone)
					    ->groupBy(DB::raw("district")) 
					    ->get();

			    $datas4 = DB::table("zambia_district")
					    ->select(DB::raw("COUNT(*) as value, name")) 
					    ->where('province', '=', $prov) 
					    ->where('name', '=', $dist) 
					    ->groupBy(DB::raw("name")) 
					    ->get();

				$dataschw = DB::table("zambia_children")
					    ->select(DB::raw("COUNT(*) as value, chw_phone"))
					    ->where('province', '=', $prov)  
					    ->where('district', '=', $dist)
					    ->where('health_facility', '=', $faci)
					    ->where('zone', '=', $zone)
					    ->groupBy(DB::raw("chw_phone")) 
					    ->get();

				$dataschw2 = DB::table("zambia_chw")
					    ->select(DB::raw("COUNT(*) as value, chw_phone")) 
					    ->where('province', '=', $prov) 
					    ->where('district', '=', $dist)
					    ->where('health_facility', '=', $faci)
					    ->where('zone', '=', $zone)
					    ->groupBy(DB::raw("chw_phone")) 
					    ->get();
        }


        if(is_null($datas)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }

        if(is_null($datas2)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }

        if(is_null($datas3)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }

        if(is_null($datas4)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }

        if(is_null($dataschw)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }

        if(is_null($dataschw2)) {
       	   return response(['key' => 'value'], Response::HTTP_NOT_FOUND);
        }

        foreach ($datas as $data) { 
           $facility = $facility + 1;
        }

        foreach ($datas2 as $data) { 
           $facilitytot = $facilitytot + 1;
        }

        foreach ($datas3 as $data) { 
           $district = $district + 1;
        }

        foreach ($datas4 as $data) { 
           $districttot = $districttot + 1;
        }

        foreach ($dataschw as $data) { 
           $chw = $chw + 1;
        }

        foreach ($dataschw2 as $data) { 
           $chw2 = $chw2 + 1;
        }
        
        $res = array('facility'=>$facility,'facilitytot'=>$facilitytot,'district'=>$district,'districttot'=>$districttot,'chw'=>$chw,'tot_chw'=>$chw2);
		 return response()->json([
		    $res
		]);
		
		 
		 //return view('blog.blogOne')->with('children',$children);
	}
}
