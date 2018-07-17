<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Email;
use App\FormValidate;

class SessionsController extends Controller
{
    function __construct(){
    	$this->middleware('guest', ['except' => ['destroy']]);
        $this->user = new User();
        $this->formValidate = new FormValidate();
    }

	public function create(){
		return view('account.login');
	}

	public function store(Request $request){
		$result = $this->formValidate->login($request);

        if(!$result->fails()) {
			$user = $this->user::where('email',$request->email)
				->where('password',md5($request->password));

			if(count($user->get()) == 1){
				$getUser = $user->get();

				auth()->login($getUser[0]);

		        return redirect()->home();
			}else{
				return back()->withErrors(['message' => 'Incorrect Email Address or password'])->withInput();
			}
		}else{
			return back()->withErrors($result)->withInput();
        }
	}

	public function destroy(){
		auth()->logout();

        return redirect('/account/login');
	}

    public function forgotCreate(){
        return view('account.forgot-password');
    }

    public function forgotStore(Request $request){
        $result = $this->formValidate->forgot($request);

		$user = $this->user::where('email',$request->email);

		if(count($user->get()) == 1){
	        $body = new \stdClass();
	        $body->to = $user->get()[0]->firstname . " " . $user->get()[0]->lastname;
	        $body->url = base64_encode("forgot=" . $user->get()[0]->id);
	        $body->subject = "Forgot Password | Octane";

	        $mailer = new Email($body);

	        DB::table('sessions')->insert(['hash' => '1']);

	        Mail::to($user->get()[0]->email)->send($mailer->forgotPassword($body->subject));

            return back()->with(['message' => 'Sent an email to ' . $request->email . ' for to reset your password.']);
        }else{
            return back()->withErrors(['message' => 'Email address not registered.'])->withInput();
        }
    }

    public function token($token){
		return base64_decode($token);
    }
}
