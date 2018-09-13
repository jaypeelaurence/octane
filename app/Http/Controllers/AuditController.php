<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;
use App\FormValidate;
use App\Audit;
use App\Account;

class AuditController extends Controller
{
    function __construct(){
        $this->report = new Report();
        $this->formValidate = new FormValidate();
        $this->audit = new Audit();
        $this->account = new Account();
    }

    public function index(){
        $users = $this->account->listUserFullName();

        // return $this->audit->log('asdasd');

        return view('report.audit', compact('users'));
    }

    public function show(Request $request){
        return $request->all();
    	// $users = $this->account->listUserFullName();

    	// // return $this->audit->log('asdasd');

     //    return view('report.audit', compact('users'));
    }
}
