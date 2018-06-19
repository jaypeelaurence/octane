<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AccountController extends Controller
{
	public function index(){
		return 'manageAccount.index';
	}

	public function add(){
		return 'manageAccount.add';
	}

	public function edit(User $uid){
		return view();
	}

	public function delete(User $uid){
		return $uid;
	}
}
