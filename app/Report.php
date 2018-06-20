<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

use App\Server;

class Report extends Server;
{
    function __construct(){
		$this->server = new Server();
	}
}
