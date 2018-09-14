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
        return view('report.audit');
    }

    public function show(Request $request){
        $result = $this->formValidate->auditReport($request);

        if ($result->fails()) {
            return back()->withErrors($result)->withInput();
        }else{
            $request->all();
        }
    }
}
