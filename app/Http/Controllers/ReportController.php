<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;
use App\FormValidate;

class ReportController extends Controller
{
    function __construct(){
        $this->report = new Report();
        $this->formValidate = new FormValidate();
    }

    public function index(){
        $account = $this->report->listAccount();

        return view('report.index', compact('account'));
    }

    public function show(Request $request){
        $account = $this->report->listAccount();

        $result = $this->formValidate->queryReport($request);

        if ($result->fails()) {
            return back()->withErrors($result)->withInput();
        }else{
            if($request->sender){
                $listTrans = $this->report->transSenderId($request);

                $transactions['type'] = "senderId";
                $transactions['data'] = $listTrans;
            }else{
                $listTrans = $this->report->transAccount($request);

                $transactions['type'] = "account";
                $transactions['accountName'] = $listTrans['accountName'];
                $transactions['column'] = $listTrans['column'];
                $transactions['data'] = $listTrans['data'];
            }
        }

        return view('report.index', compact(['account','transactions']));
    }

    public function get(Request $request){
        $account = $this->report->listAccount();

        $generateReport = $this->report->generateReport(json_decode(base64_decode($request->transactions)));

        return $generateReport;
    }
}
