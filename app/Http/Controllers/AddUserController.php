<?php

namespace blog\Http\Controllers;

use Illuminate\Http\Request;
use blog\User;
use Validator;
use Mail;
use Auth; 
use Session;
use blog\Percent; 
use blog\Http\Requests;

class AddUserController extends Controller
{
    public function lister()
    {
        $roles = Auth::user()->roles; 
        if($roles == 'admin'){ 
            return view('users.lister');
        }
        else
        {
        	return redirect('/');
        }
    	
    } 
    public function listerJson()
    {
        
        $users = User::all();
            return $users;
        
        
    } 
    public function add()
    {
        $roles = Auth::user()->roles; 
        if($roles == 'admin'){
        	 $provinces = Percent::select('province')
                    ->groupBy('province') 
                    ->get(); 
            return view('users.add')->with('provinces',$provinces);
        }
        else
        {
        	return redirect('/');
        }
    	
    }

    public function register(Request $request)
    {
    	$this->validator($request);
    	User::create([
            'name'     => $request['name'],
            'email'    => $request['email'],
            'roles'    => $request['roles'],
            'province' => $request['province'],
            'district' => $request['district'], 
            'facility' => $request['facility'],
            'zone'     => $request['zone'], 
            'password' => bcrypt($request['password']),
        ]);
        $name     = $request['name'];
        $email    = $request['email'];
        $password = $request['password'];
        $data = array('name'=>$name, "email" => $email, "password" => $password);
        Mail::send('users.mail', $data, function($message) {
        $message->to('acermamadou@gmail.com', 'mVaccination')
         ->subject('mVaccination');
        $message->from('vmvaccination@gmail.com','mVaccination');
    }   );

    	return redirect('/home');
    }

    protected function validator($request)
    {
        return $this->Validate($request, [
            'name' => 'required|max:255',
            'roles' => 'required|max:255', 
            'province' => 'max:255', 
            'district' => 'max:255', 
            'facility' => 'max:255',
            'zone' => 'max:255', 
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

  
}
