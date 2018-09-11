<?php

namespace App\Http\Controllers;

use App\Account;
use App\FormValidate;
use App\User;
use App\Audit;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    function __construct(){
        $this->account = new Account();
        $this->formValidate = new FormValidate();
        $this->audit = new Audit();
    }

    public function index(){
        $user = $this->account->viewUser();

        return view('manage-account.index', compact('user'));
    }

    public function create(){
        return view('manage-account.add');
    }

    public function store(Request $request){
        $result = $this->formValidate->addUser($request);
        
        if ($result->fails()) {
            return redirect('manage-account/add')->withErrors($result)->withInput();
        }else{
            $uid = $this->account->addUser($request->all());

            $message = "Account ".request('firstname')." ".request('lastname')." was created!";

            $this->audit->log('200',$message);

            return redirect('manage-account/'.$uid)->with('message', $message);
        }
    }

    public function show($uid) {
        if(count($this->account->viewUser($uid)) != 0){
            $user = $this->account->viewUser($uid)[0];

            return view('manage-account.show', compact('user'));
        }else{
            return redirect('error/102');
        }
    }

    public function edit($uid){
        if(count($this->account->viewUser($uid)) != 0){
            $user = $this->account->viewUser($uid)[0];
           
            return view('manage-account.edit', compact('user'));
        }else{
            return redirect('error/102');
        }
    }

    public function update(Request $request, User $uid){
        $result = $this->formValidate->editUser($request);
        
        if ($result->fails()) {
            return redirect('manage-account/'.$uid->id.'/edit')->withErrors($result)->withInput();
        }else{
            $this->account->editUser($request->all(), $uid);

            $message = "Account ".$uid->firstname." ".$uid->lastname." was edited!";

            $this->audit->log('201',$message);

            return redirect('manage-account/'.$uid->id)->with('message', $message);
        }
    }

    public function destroy(User $uid){
        $this->account->deleteUser($uid);

        $message =  "Account ".$uid->firstname." ".$uid->lastname." was deleted!";
        
        $this->audit->log('203',$message);

        return redirect('manage-account/')->with('message', $message);
    }

    public function change($uid){
        if(count($this->account->viewUser($uid)) != 0){
            $user = $this->account->viewUser($uid)[0];
            
            return view('account.change', compact('user'));
        }else{
            return redirect('error/102');
        }        
    }

    public function changeUpdate(Request $request, User $uid){
        $result = $this->formValidate->changePass($request, $uid);

        if ($result->fails()) {
            return redirect('account/'.$uid->id.'/change-password')->withErrors($result)->withInput();
        }else{
            $this->account->editUser($request->all(), $uid);

            $message =  "Account ".$uid->firstname." ".$uid->lastname." changed password!";

            $this->audit->log('202',$message);

            return redirect('account/'.$uid->id)->with('message', $message);
        }
    }
}