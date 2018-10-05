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
      "password" => "required|confirmed|min:8"
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

  public function forgot(Request $request){
    $rules = [
      "email" => "required|email",
    ];

    $validator = Validator::make($request->all(), $rules);

    return $validator;
  }

  public function queryReport(Request $request){
    $rules = [
      "start" => "required",
      "end" => "required",
      "account" => "required"
    ];

    $validator = Validator::make($request->all(), $rules);

    return $validator;
  }

  public function auditReport(Request $request){
    $rules = [];

    if($request->start){
      $rules['start'] = 'required'; 
      $rules['end'] = 'required'; 
    }

    $validator = Validator::make($request->all(), $rules);
    
    return $validator;
  }

  public function newPass(Request $request){
    $rules = [
      "password" => "required|confirmed"
    ];

    $validator = Validator::make($request->all(), $rules);

    return $validator;
  }
}