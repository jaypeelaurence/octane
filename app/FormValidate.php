<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;

class FormValidate extends Model
{
    function __construct(){
        $this->account = new Account;
    }

 	public function addUser(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => "required|unique:users,username",
            'email' => "required|email",
            'password' => "required|confirmed|min:6	",
            'name' => "required",
            'role' => "required",
        ]);

       	return $validator;
	}

 	public function editUser(Request $request){
 		$rules = array();

 		if($request->input('username') != null){
 			$rules['username'] = "unique:users,username";
 		}
 		
 		if($request->input('email') != null){
 			$rules['email'] = "email";
 		}

 		if($request->input('password') != null){
 			$rules['password'] = "confirmed|min:6";
 		}

        $validator = Validator::make($request->all(), $rules);

       	return $validator;
	}
}
