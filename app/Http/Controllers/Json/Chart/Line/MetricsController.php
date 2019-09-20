<?php

namespace blog\Http\Controllers\Json\Chart\Line;

use Illuminate\Http\Request;
use blog\Http\Controllers\Controller;

use blog\Http\Requests; 
use blog\Children; 
use blog\Chw; 
use blog\Vaccine;    
use DB;
use Jenssegers\Date\Date;
use blog\User;
use Auth; 

class MetricsController extends Controller
{
      public function getData(Request $request){ 
       
	      $res2=array();
	      $value = 0;

	      $roles = Auth::user()->roles;
	      $prov = Auth::user()->province;
	      $dist = Auth::user()->district; 
	      $faci = Auth::user()->facility;
	      $zone     = Auth::user()->zone;
	      
	      if($roles == 'admin')
          {
          	 $data_created_at = DB::table("zambia_children")
				    ->select(DB::raw("COUNT(*) as value, created_at"))  
				    ->groupBy(DB::raw("created_at")) 
				    ->get();
          }
          if($roles == 'viewer-province')
          {
          	 $data_created_at = DB::table("zambia_children")
				    ->select(DB::raw("COUNT(*) as value, created_at"))  
				    ->where('province', '=', $prov) 
				    ->groupBy(DB::raw("created_at")) 
				    ->get();
          }
          if($roles == 'viewer-district')
          {
          	 $data_created_at = DB::table("zambia_children")
				    ->select(DB::raw("COUNT(*) as value, created_at"))  
				    ->where('province', '=', $prov) 
				    ->where('district', '=', $dist) 
				    ->groupBy(DB::raw("created_at")) 
				    ->get();
          }
          if($roles == 'viewer-facility')
          {
          	 $data_created_at = DB::table("zambia_children")
				    ->select(DB::raw("COUNT(*) as value, created_at"))  
				    ->where('province', '=', $prov) 
				    ->where('district', '=', $dist) 
				    ->where('health_facility', '=', $faci) 
				    ->groupBy(DB::raw("created_at")) 
				    ->get();
          }
          if($roles == 'viewer-zone')
          {
          	 $data_created_at = DB::table("zambia_children")
				    ->select(DB::raw("COUNT(*) as value, created_at")) 
				    ->where('province', '=', $prov)  
				    ->where('district', '=', $dist) 
				    ->where('health_facility', '=', $faci) 
				    ->where('zone', '=', $zone) 
				    ->groupBy(DB::raw("created_at")) 
				    ->get();
          }
	     

	      foreach ($data_created_at as $data) { 
	         if($data->created_at != '')
	         {
	             $created_at = str_replace(' ', 'T', $data->created_at);
	             $value = $value + $data->value;
	             $res2[] = array(
	                $created_at, $value,null,
	             ); 
	         } 
	      }
	 
	         return response()->json(
	            $res2
	        );
       
        //return $datas;
     }

     public function getDataChw(Request $request){  
	      $res2=array();
	      $value = 0;

	      $roles = Auth::user()->roles;
	      $prov = Auth::user()->province;
	      $dist = Auth::user()->district; 
	      $faci = Auth::user()->facility;
	      $zone     = Auth::user()->zone;
	      

	      if($roles == 'admin')
          {
          	 $data_created_at = DB::table("zambia_chw")
	          ->select(DB::raw("COUNT(*) as value, created_at"))  
	          ->groupBy(DB::raw("created_at")) 
	          ->get();
          }

          if($roles == 'viewer-province')
          {
          	 $data_created_at = DB::table("zambia_chw")
	          ->select(DB::raw("COUNT(*) as value, created_at")) 
	          ->where('province', '=', $prov)   
	          ->groupBy(DB::raw("created_at")) 
	          ->get();
          }

          if($roles == 'viewer-district')
          {
          	 $data_created_at = DB::table("zambia_chw")
	          ->select(DB::raw("COUNT(*) as value, created_at"))  
	          ->where('province', '=', $prov)  
	          ->groupBy(DB::raw("created_at")) 
	          ->get();
          }

          if($roles == 'viewer-facility')
          {
          	 $data_created_at = DB::table("zambia_chw")
	          ->select(DB::raw("COUNT(*) as value, created_at")) 
	          ->where('province', '=', $prov)  
			  ->where('district', '=', $dist) 
		      ->where('health_facility', '=', $faci)   
	          ->groupBy(DB::raw("created_at")) 
	          ->get();
          }

          if($roles == 'viewer-zone')
          {
          	 $data_created_at = DB::table("zambia_chw")
	          ->select(DB::raw("COUNT(*) as value, created_at")) 
	          ->where('province', '=', $prov)  
			  ->where('district', '=', $dist) 
			  ->where('health_facility', '=', $faci) 
		      ->where('zone', '=', $zone)  
	          ->groupBy(DB::raw("created_at")) 
	          ->get();
          } 
	      

	      foreach ($data_created_at as $data) { 
	         if($data->created_at != '')
	         {
	             $created_at = str_replace(' ', 'T', $data->created_at);
	             $value = $value + $data->value;
	             $res2[] = array(
	                $created_at, $value,null,
	             ); 
	         } 
	      }
	 
	         return response()->json(
	            $res2
	        );
	       
	        //return $datas;
     }
}
