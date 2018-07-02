<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Account;

class MainController extends Controller{
    function __construct(){
        $this->account = new Account;
    }

	public function show(User $uid){
        $user = $this->account->viewUser($uid);

        return view('account.show', compact('user'));
	}

	public function index(){
		return view('main.index');
	}
}
