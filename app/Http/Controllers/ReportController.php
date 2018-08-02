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

        $dateRange = [
            $request->start,
            $request->end
        ];

        if ($result->fails()) {
            return back()->withErrors($result)->withInput();
        }else{
            if($request->sender){
                $listTrans = $this->report->transSender($request);

                $transactions = [
                    'type'          => 'sender',
                    'dateRange'     => $dateRange,
                    'accountName'   => $listTrans['accountName'],
                    'senderName'    => $listTrans['senderName'],
                    'column'        => $listTrans['column'],
                    'data'          => $listTrans['data']
                ];
            }else{
                $listTrans = $this->report->transAccount($request);

                $transactions = [
                    'type'          => 'account',
                    'dateRange'     => $dateRange,
                    'accountName'   => $listTrans['accountName'],
                    'column'        => $listTrans['column'],
                    'data'          => $listTrans['data']
                ];
            }
        }

        return view('report.index', compact(['account','transactions']));
    }

    public function load($idList = null){
        if($idList){
            return $this->report->listSender($idList);
        }else{
            return $this->report->listAccount();
        }
    }

    public function search(){
       return $this->report->listAccount();
    }
    
    public function get(Request $request){
        $account = $this->report->listAccount();

        $generateReport = $this->report->generateReport(json_decode(base64_decode($request->transactions)));

        return $generateReport;
    }

    public function loadAcct($strAcct){
       return $this->report->listAccount($strAcct);
    }
}