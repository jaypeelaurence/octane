<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    function __construct(){
    	$this->middleware('guest', ['except' => 'destroy']);
        $this->user = new User;
    }

	public function create(){
		return view('account.login');
	}

	public function store(Request $request){
		$user = $this->user::where('username',$request->username)
			->where('password',md5($request->password));

		if(count($user->get()) == 1){
			$getUser = $user->get();

			auth()->login($getUser[0]);

	        return redirect()->home();
		}else{
			return back()->withErrors(['message' => 'Incorrect username or password']);
		}
	}

	public function destroy(){
		auth()->logout();

        return redirect('/account/login');
	}
}