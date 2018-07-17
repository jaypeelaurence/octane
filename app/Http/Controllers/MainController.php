<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Account;
use App\ErrorCode;
use App\Email;
		
class MainController extends Controller{
    function __construct(){
        $this->account = new Account();
    }

	public function show($uid){
        $user = $this->account->viewUser($uid)[0];

        return view('account.show', compact('user'));
	}

	public function index(){
		return view('main.index');
	}

	public function error($code){
		$getError = new ErrorCode($code);

		$error = [
			'code' => $getError->code(),
			'message' => $getError->message(),
		];

		return view('main.error', compact("error"));
	}
}