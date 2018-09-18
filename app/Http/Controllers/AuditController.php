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
        $getLog = $this->audit->getLog();

        $transactions = [
            'type'          => 'auditReport',
            'dateRange'     => $getLog['dateRange'],
            'accountName'   => $getLog['accountName'],
            'column'        => $getLog['column'],
            'data'          => $getLog['data']
        ];

        return view('report.audit', compact(['transactions']));
    }

    public function show(Request $request){
        $result = $this->formValidate->auditReport($request);

        if ($result->fails()) {
            return back()->withErrors($result)->withInput();
        }else{
            $getLog = $this->audit->getLog($request);

            $transactions = [
                'type'          => 'auditReport',
                'dateRange'     => $getLog['dateRange'],
                'accountName'   => $getLog['accountName'],
                'column'        => $getLog['column'],
                'data'          => $getLog['data']
            ];
        }

        $message = "Audit " . implode(' ',$request->all()) . " was generated!";

        $this->audit->log('401',$message);

        return view('report.audit', compact(['transactions']));
    }
}
