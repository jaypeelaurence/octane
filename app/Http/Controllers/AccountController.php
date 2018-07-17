<?php

namespace App\Http\Controllers;

use App\Account;
use App\FormValidate;
use App\User;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    function __construct(){
        $this->account = new Account();
        $this->formValidate = new FormValidate();
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

            return redirect('manage-account/'.$uid)->with('message', "Account ".request('firstname')." ".request('lastname')." was created!");
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

            return redirect('manage-account/'.$uid->id)->with('message', "Account ".$uid->firstname." ".$uid->lastname." was edited!");
        }
    }

    public function destroy(User $uid){
        $this->account->deleteUser($uid);

        return redirect('manage-account/')->with('message', "Account ".$uid->firstname." ".$uid->lastname." was deleted!");
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

            return redirect('account/'.$uid->id)->with('message', "Account ".$uid->firstname." ".$uid->lastname." changed password!");
        }
    }
}