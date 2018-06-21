<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

use App\Server;
use App\Excel;

class Report extends server
{
    function __construct(){
		$this->server = new Server();
		$this->excel = new Excel();
	}

	public function index(){
		
	}

	public function generate(){
		return $this->excel->load('hi');
	}
}