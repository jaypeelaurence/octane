<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Validator;

class FormValidate extends Model
{
    function __construct(){
      $this->account = new Account();
    }

 	public function addUser(Request $request){
 		$rules = [
      'lastname' => "required",
      'firstname' => "required",
      'email' => "required|unique:users,email|email",
      'mobile' => "required|unique:users,mobile|mobile",
      'role' => "required",
    ];

    $validator = Validator::make($request->all(), $rules);

   	return $validator;
	}

 	public function editUser(Request $request){
 		$rules = [];
    
    if($request->input('email') != null){
      $rules['email'] = "unique:users,email|email";
    }
    
    if($request->input('mobile') != null){
      $rules['mobile'] = "unique:users,mobile|mobile";
    }

 		if($request->input('password') != null){
 			$rules['password'] = "confirmed|min:6";
 		}

    $validator = Validator::make($request->all(), $rules);

   	return $validator;
	}

  public function changePass(Request $request, User $uid){
    $rules = [
      "oldPassword" => [
        "required",
        "checkPass:".$uid->password,
      ],
      "password" => "required|confirmed|min:6"
    ];

    $validator = Validator::make($request->all(), $rules);

    return $validator;
  }

 	public function login(Request $request){
		$rules = [
      "email" => "required|email",
      "password" => "required"
		];

		$validator = Validator::make($request->all(), $rules);

   	return $validator;
	}
}