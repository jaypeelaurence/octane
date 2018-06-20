<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;

class ReportController extends Controller
{
	function __construct(){
		$this->report = new Report();
	}

	public function generate(){
		return "Generating report";
	}

	public function dowload(){
		return "Downloading report";
	}
}
