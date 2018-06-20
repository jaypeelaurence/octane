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

	// public function edit(User $uid){
	// 	$getForm = array(
	// 		'id' => $uid,
	// 		'username' => 'jaypee'.rand(0,999),
	// 		'email' => 'jaypee'.rand(0,999).'@adspark.ph',
	// 		'password' => 'password'.rand(0,999),
	// 		'name' => 'Jaypee Laurencec Cocjin'.rand(0,999),
	// 		'role' => 'Admin'
	// 	);

	// 	return $this->account->editUser($getForm);
	// }

	// public function delete(User $uid){
	// 	return $uid;
	// }
}