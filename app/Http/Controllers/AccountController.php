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

		$user = $this->account->addUser($getForm);
		
		return view('manage-account.index', compact('user'));
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

		$user = $this->account->updateUser($uid, $getForm);

		return view('manage-account.edit', compact('user'));
	}

	public function delete(User $uid){
		$user = $this->account->deleteUser($uid);

		return view('manage-account.index', compact('user'));
	}

	public function login(){
		return view('account.login');
	}

	public function logout(){
		return view('account.logout');
	}

	public function changePass(){
		return view('account.change-password');
	}
}