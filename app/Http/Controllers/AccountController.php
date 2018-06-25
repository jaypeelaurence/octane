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
		$user = $this->account->listUser();

		return view('manage-account.index', compact('user'));
	}

	public function add(){
		$getForm = array(	
			'username' => 'jaypee',
			'email' => 'jaypee'.rand(0,999).'@adspark.ph',
			'password' => 'password123',
			'name' => 'Jaypee Laurencec Cocjin',
			'role' => 'User'
		);

		return $this->account->addUser($getForm);
	}

	public function view(User $uid){
		$user = $this->account->viewUser($uid);

		return view('account.index', compact('user'));

	}

	public function edit(User $uid){
		$getForm = array(	
			'username' => 'jaypee'.rand(0,999),
			'email' => 'jaypee'.rand(0,999).'@adspark.ph',
			'password' => 'password123'.rand(0,999),
			'name' => 'Jaypee Laurencec Cocjin',
			'role' => 'Admin'
		);

		return $this->account->updateUser($uid, $getForm);
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