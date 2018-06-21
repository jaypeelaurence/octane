<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

use App\Users;
use App\Database;

class Account extends Database
{
	function __construct(){
		$this->table = 'users';
	}

    public function listUser(){
		return $this->read($this->table);
	}

    public function addUser($getForm){
		$data = array(
			'username' => $getForm['username'],
			'email' => $getForm['email'],
			'password' => md5($getForm['password']),
			'name' => $getForm['name'],
			'role' =>  $getForm['role'],
			'remember_token' => md5($getForm['username'].'+'.$getForm['name'].'+'.$getForm['role']),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		);

		return $this->create($this->table, $data);
	}

	public function viewUser($uid){
		$condition = array();
		$condition[] = array('where', array('id',$uid['id']));

		return $this->read($this->table, $condition);
	}

	public function updateUser($uid, $getForm){
		$data = array(
			'username' => $getForm['username'],
			'email' => $getForm['email'],
			'password' => md5($getForm['password']),
			'name' => $getForm['name'],
			'role' =>  $getForm['role'],
			'updated_at' => date('Y-m-d H:i:s')
		);

		$condition = array();
		$condition[] = array('where', array('id',$uid['id']));
		$condition[] = array('update', $data);

		return $this->edit($this->table, $condition);
	}

	public function deleteUser($uid, $condition){
		$condition = array(
			array(
				'where',
				array(
					'id',
					$uid['id']
				)
			)
		);
		return $this->remove($this->table, $condition);
	}
}