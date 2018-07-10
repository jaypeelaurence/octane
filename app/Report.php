<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    function __construct(){
    	$this->query = DB::connection('mysql2');
    }

    public function getAccount(){
		return $this->query->table('esme_credential')->select('system_id')->get();
    }
}
