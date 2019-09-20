<?php
namespace blog\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use blog\Percent; 
use blog\Children; 
use blog\Vaccine; 
use DB;

class PercentController extends Controller
{
	  public function get()
	  {
	  	 $childrens = Percent::select('*') 
                                  ->whereBetween('age', [12, 23]) 
                                  ->get();
         $count = count($childrens);

          return $count;
	  }

      public function index()
      { 
            //$childrens = Children::all();

            $childrens = Children::select('*') 
                                  ->where('age', '<=', 23) 
                                  ->get(); 
            foreach ($childrens as $child) {
	             $uuid         = $child->uuid;
	             $dob          = $child->dob;
	             $age          = $child->age; 
	             $sex          = $child->sex; 
	             $mvacc_id     = $child->mvacc_id; 

	             $province     = $child->province; 
	             $district     = $child->district; 
	             $facility     = $child->health_facility; 
	             $zone         = $child->zone;
	             $location     = $child->location; 
	             $chw_phone    = $child->chw_phone; 
	             $mother_phone = $child->mother_phone;
	             $dist_faci_zone = $child->dist_faci_zone; 

	             $bcg = 0;
	             $opv = 0;
	             $pcv = 0;
	             $dtp = 0;
	             $rota = 0;
	             $measles = 0;
	             $fully = 0;

	             $vaccines = Vaccine::select('uuid', 'vaccine')
                                  ->where('uuid', '=', $uuid)   
                                  ->get(); 
                 foreach ($vaccines as $vaccine) {
	                    if($vaccine->vaccine == 'BCG')
		                {
		                    $bcg = 1;
		                } 
		                if($vaccine->vaccine == 'OPV')
		                {
		                    $opv = $opv + 1;
		                }
		                if($vaccine->vaccine == 'DTP')
		                {
		                    $dtp = $dtp + 1;
		                }
		                if($vaccine->vaccine == 'PCV')
		                {
		                    $pcv = $pcv + 1;
		                }
		                if($vaccine->vaccine == 'Rota')
		                {
		                    $rota = $rota + 1;
		                }
		                if($vaccine->vaccine == 'Measles')
		                {
		                    $measles = $measles + 1;
		                } 
		                

		                if($bcg == 1 and $opv >= 3 and $dtp >= 3 and $pcv >= 3 and $rota >= 2 and $measles >= 1)
		                {
		                    $fully = 1;
		                }
		                else
		                {
		                    $fully = 0;
		                }  
                 }
                  
                 $checkpercent = Percent::whereUuid($uuid)->first();
                 if($checkpercent == "")
                 {     
                 	 Percent::create([
			            'uuid' =>  $uuid,
			            'age' => $age,
			            'sex' => $sex,
			            'province' => $province,
			            'district' => $district,
			            'health_facility' => $facility,
			            'zone' => $zone,
			            'location' => $location,
			            'dob' => $dob,
			            'chw_phone' => $chw_phone,
			            'mother_phone' => $mother_phone,
			            'dist_faci_zone' => $dist_faci_zone, 
			            'bcg' => $bcg,
			            'opv' => $opv,
			            'dtp' => $dtp,
			            'pcv' => $pcv,
			            'rota' => $rota,
			            'measles' => $measles,
			            'fully' => $fully,
			            'mvacc_id' => $mvacc_id,
		             ]);
                 }
                 else
                 {
                 	 DB::table('zambia_percent')
                 	    ->where('uuid', $uuid)
			            ->update([
			            'age' => $age,
			            'sex' => $sex,
			            'province' => $province,
			            'district' => $district,
			            'health_facility' => $facility,
			            'zone' => $zone,
			            'location' => $location,
			            'dob' => $dob,
			            'chw_phone' => $chw_phone,
			            'mother_phone' => $mother_phone,
			            'dist_faci_zone' => $dist_faci_zone, 
			            'bcg' => $bcg,
			            'opv' => $opv,
			            'dtp' => $dtp,
			            'pcv' => $pcv,
			            'rota' => $rota,
			            'measles' => $measles,
			            'fully' => $fully,
			            'mvacc_id' => $mvacc_id
			        ]);


                 }
                
                
                 $bcg = 0;
	             $opv = 0;
	             $pcv = 0;
	             $dtp = 0;
	             $rota = 0;
	             $measles = 0;
	             $fully = 0;
            }
            die('ok');
           
      }

}
