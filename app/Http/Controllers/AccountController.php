<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Account;

class AccountController extends Controller
{
	function __construct(){
		$this->account = new Account();
	}

	public function index(){
		return $this->account->listUser();
	}

	public function add(){
		$getForm = array(	
			'username' => 'jaypee',
			'email' => 'jaypee@adspark.ph'.rand(0,999),
			'password' => 'password123',
			'name' => 'Jaypee Laurencec Cocjin',
			'role' => 'User'
		);

		return $this->account->addUser($getForm);
	}

	public function view(User $uid){
		return $this->account->viewUser($uid);
	}

	public function edit(User $uid){
		$getForm = array(	
			'username' => 'jaypee',
			'email' => 'jaypee@adspark.ph'.rand(0,999),
			'password' => 'password123',
			'name' => 'Jaypee Laurencec Cocjin',
			'role' => 'User'
		);
	}

	public function delete(User $uid){
		return $this->account->deleteUser($uid);
	}

	public function logout(){
		return 'You are logged out.';
	}

	public function changePass(){
		return 'You are changing your password.';
	}
}