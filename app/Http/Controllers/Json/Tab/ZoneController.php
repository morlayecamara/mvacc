<?php

namespace blog\Http\Controllers\Json\Tab;

use Illuminate\Http\Request;

use blog\Http\Requests;
use blog\Percent;  
use blog\User;
use Validator;
use Auth; 
use Session; 
use View;
use File;
use Response;
use blog\Http\Controllers\Controller;
use blog\Http\Controllers\Percent\PercentZoneController; 
use blog\Http\Controllers\Percent\PercentZoneFaciController; 
use blog\Http\Controllers\Percent\PercentZoneDistController; 
use blog\Http\Controllers\Percent\PercentZoneProvController; 

class ZoneController extends Controller
{
   
      
    public function getData(Request $request)
    { 
       $email = Auth::user()->email; 

       $arrayZone = array();
       $province =  $request->input('province');
       $district =  $request->input('district');
       $facility =  $request->input('facility');

       if($province == '' and $district == '' and $facility == '')
       {
           $data = (new PercentZoneProvController)->getData();   
       }
       elseif($province != '' and $district == '' and $facility == '')
       {
           $data = (new PercentZoneDistController)->getData($province);   
       }
       elseif($province != '' and $district != '' and $facility == '')
       {
           $data = (new PercentZoneFaciController)->getData($province,$district);   
       }
       else
       {
           $data = (new PercentZoneController)->getData($province,$district,$facility);  
       } 

       $folder = $email;
       $path = public_path().'/json/tab/zone/' . $folder;
       File::makeDirectory($path, $mode = 0777, true, true);

       foreach ($data as $d) {
        $arrayZone[] = array( 
                'zone'=>$d['zone'],'facility'=>$d['facility'],'province'=>$d['province'],
                'district'=>$d['district'],
                'tot'=>$d['all'],'children_1823'=>$d['children_1823'], 
                'children_1223'=>$d['children_1223'],'fully'=>$d['fully'],
                'bcg'=>$d['bcg'],'opv'=>$d['opv'],
                'dtp'=>$d['dtp'],'pcv'=>$d['pcv'],
                'rota'=>$d['rota'],'measles'=>$d['measles'], 
          ); 
       } 

       $data = json_encode($arrayZone);
       
       $fileName = 'getData.blade.php';
       File::delete(public_path('/json/tab/zone/'.$folder.'/'.$fileName)); 
       //var_dump(resource_path('/upload/json/'.$fileName));die();
       File::put(public_path('/json/tab/zone/'.$folder.'/'.$fileName),$data); 

       return $data;
    } 
}
