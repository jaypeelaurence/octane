<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;

use App\Email;
use App\FormValidate;
use App\Account;
use App\Audit;

class SessionsController extends Controller
{
    function __construct(){
    	$this->middleware('guest', ['except' => ['destroy']]);
        $this->user = new User();
        $this->account = new Account();
        $this->formValidate = new FormValidate();
        $this->audit = new Audit();
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

				$message = "user " . $getUser[0]->email . ' logged in';

		        $this->audit->log('101',$message);

		        return redirect()->home();
			}else{
				return back()->withErrors(['message' => 'Incorrect Email Address or password'])->withInput();
			}
		}else{
			return back()->withErrors($result)->withInput();
        }
	}

	public function destroy(){
		$message = "user " . Auth::user()->email . ' logged out';

        $this->audit->log('102',$message);

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
			$message = "user " . $user->get()[0]->email . ' request forgot password.';

	        $this->audit->log('103',$message,$user->get()[0]->email);

	        $body = new \stdClass();
	        $body->to = $user->get()[0]->firstname . " " . $user->get()[0]->lastname;
	        $body->url = base64_encode("type=forgot&uid=" . $user->get()[0]->id . "&time=" . time());
	        $body->subject = "Forgot Password | Octane";

	        $mailer = new Email($body);

	        DB::table('sessions')->insert(['hash' => $body->url]);

	        Mail::to($user->get()[0]->email)->send($mailer->forgotPassword($body->subject));

            return back()->with(['message' => 'Sent an email to ' . $request->email . ' to reset your password.']);
        }else{
            return back()->withErrors(['message' => 'Email address not registered.'])->withInput();
        }
    }

    public function token($hash){
		$token = DB::table('sessions')->where('hash', $hash)->get();

		if(count($token) != 0){
			parse_str(base64_decode($token[0]->hash), $data);

        	return view('account.token', compact(['data', 'hash']));
		}else{
			return redirect('/');
		}
    }

    public function tokenUpdate(Request $request, $hash){
    	$result = $this->formValidate->newPass($request);

        if(!$result->fails()) {
        	$data = $request->all();

            $user = $this->account->changePass($data['password'], $data['uid']);

			$message = "user " . $user->email . ' change password.';

	        $this->audit->log('104',$message, $user->email);

            auth()->login($user);

            $token = DB::table('sessions')->where('hash', $hash)->delete();

            return redirect('/account/login');
		}else{
			return back()->withErrors($result)->withInput();
        }
    }
}
