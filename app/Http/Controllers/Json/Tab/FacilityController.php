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
use blog\Http\Controllers\Percent\PercentFaciController; 
use blog\Http\Controllers\Percent\PercentFaciDistController; 
use blog\Http\Controllers\Percent\PercentFaciProvController; 

class FacilityController extends Controller
{
   
      
    public function getData(Request $request)
    { 
       $email = Auth::user()->email; 

       $arrayFaci = array();
       $province =  $request->input('province');
       $district =  $request->input('district');

       if($province == '' and $district == '')
       {
           $data = (new PercentFaciProvController)->getData();   
       }
       elseif($province != '' and $district == '')
       {
           $data = (new PercentFaciDistController)->getData($province);   
       }
       else
       {
           $data = (new PercentFaciController)->getData($province,$district);  
       } 

       $folder = $email;
       $path = public_path().'/json/tab/facility/' . $folder;
       File::makeDirectory($path, $mode = 0777, true, true);

       foreach ($data as $d) {
        $arrayFaci[] = array( 
                'facility'=>$d['facility'],'province'=>$d['province'],
                'district'=>$d['district'],
                'tot'=>$d['all'],'children_1823'=>$d['children_1823'], 
                'children_1223'=>$d['children_1223'],'fully'=>$d['fully'],
                'bcg'=>$d['bcg'],'opv'=>$d['opv'],
                'dtp'=>$d['dtp'],'pcv'=>$d['pcv'],
                'rota'=>$d['rota'],'measles'=>$d['measles'], 
          ); 
       } 

       $data = json_encode($arrayFaci);
       
       $fileName = 'getData.blade.php';
       File::delete(public_path('/json/tab/facility/'.$folder.'/'.$fileName)); 
       //var_dump(resource_path('/upload/json/'.$fileName));die();
       File::put(public_path('/json/tab/facility/'.$folder.'/'.$fileName),$data); 

       return $data;
    } 
}
