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
        // $list = $this->report->getAccount();

        $account = $this->report->getAccount();

        return view('report.index', compact('account'));
    }

    public function show(Request $request){
    	return $request->all();
        // return view('report.index');
    }
}
