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
            return $this->audit->getLog($request);

            $transactions = [
                'type'          => 'auditReport',
                'dateRange'     => $dateRange,
                'accountName'   => $listTrans['accountName'],
                'column'        => $listTrans['column'],
                'data'          => $listTrans['data']
            ];
        }
        return view('report.index', compact(['transactions']));
    }
}
