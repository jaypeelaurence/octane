<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Account;

class MainController extends Controller
{
	function __construct(){
		$this->account = new Account();
	}


	public function index(){
		$user = $this->account->listUser();

		return view('main.index', compact('user'));
	}
}
