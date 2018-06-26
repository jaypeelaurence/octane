<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;

class ReportController extends Controller
{
	function __construct(){
		$this->report = new Report();
	}

	public function index(){
		return view('report.index');
	}

	public function generate(){
		return 	$this->report->generate();
	}

	public function dowload(){
		return "Downloading report";
	}
}
