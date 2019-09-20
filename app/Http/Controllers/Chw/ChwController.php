<?php
namespace blog\Http\Controllers\Chw;

use Illuminate\Http\Request;
use blog\Percent; 
use blog\Chw; 
use blog\Http\Controllers\Controller;
use Jenssegers\Date\Date;  
use blog\Http\Requests;
use DB;
use blog\User;
use Auth; 

class ChwController extends Controller
{

      public function index()
      {   
         $roles = Auth::user()->roles; 
         if($roles == 'admin')
         {
           
            return view('chw.index');
         } 
      } 

      public function getDataChwAll(Request $request)
      {    
       
            $childrens = Chw::select('uuid','chw_name', 'province', 'district',
                        'health_facility', 'location', 'chw_phone','zone')  
                        ->get(); 
       

            $data = array(
                'data'=>$childrens
              );
            return $data; 
      }

      public function getDataChwPercent(Request $request)
      {    
       
            $childrens = DB::table('zambia_chw') 
            ->join('zambia_percent', 'zambia_chw.chw_phone', '=', 'zambia_percent.chw_phone')
            ->select('zambia_chw.uuid as uuid','zambia_chw.chw_name as chw_name', 'zambia_chw.province as province', 'zambia_chw.district as district',
                        'zambia_chw.health_facility as health_facility', 'zambia_chw.location as location', 'zambia_chw.chw_phone as chw_phone','zambia_chw.zone as zone')
            ->get();

            $data = array(
                'data'=>$childrens
              );
            return $data; 
      }

      public function getDataChwMetrics(Request $request)
      {    
       
            $childrens = DB::table('zambia_chw') 
            ->join('zambia_percent', 'zambia_chw.chw_phone', '=', 'zambia_percent.chw_phone')
            ->select(DB::raw('COUNT(zambia_percent.chw_phone) as total'), 'zambia_chw.chw_phone as chw_phone', 'zambia_chw.uuid as uuid', 'zambia_chw.province as province', 'zambia_chw.district as district', 'zambia_chw.health_facility as health_facility', 'zambia_chw.location as location','zambia_chw.zone as zone','zambia_chw.chw_name as chw_name')
            ->groupBy('zambia_chw.chw_phone', 'zambia_chw.uuid', 'zambia_chw.province', 'zambia_chw.district', 'zambia_chw.health_facility', 'zambia_chw.location','zambia_chw.zone','zambia_chw.chw_name')
            ->get();
       
            $data = array(
                'data'=>$childrens
              );
            return $data; 
      }
}
