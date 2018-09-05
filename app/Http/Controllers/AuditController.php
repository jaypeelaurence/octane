<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;
use App\FormValidate;
use App\Audit;

class AuditController extends Controller
{
    function __construct(){
        $this->report = new Report();
        $this->formValidate = new FormValidate();
        $this->audit = new Audit();
    }

    public function index(){

        return view('report.audit');
    }
}
