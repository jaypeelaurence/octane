<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Validator;

class FormValidate extends Model
{
    function __construct(){
        $this->account = new Account;
    }

 	public function addUser(Request $request){
 		$rules = array(
            'username' => "required|unique:users,username",
            'email' => "required|email",
            'password' => "required|confirmed|min:6	",
            'name' => "required",
            'role' => "required",
        );

        $validator = Validator::make($request->all(), $rules);

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

 	public function changePass(Request $request, User $uid){
		$rules = array(
	        "oldPassword" => [
	        	"required",
	        	"checkPass:".$uid->password,
	        ],
	        "password" => "required|confirmed|min:6"
		);

		$validator = Validator::make($request->all(), $rules);

       	return $validator;
	}
}