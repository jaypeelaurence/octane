<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    function __construct(){
    	$this->query = DB::connection('db_test');
    }

    public function getAccount(){
		return $this->query->table('esme_credential')->select('id','system_id')->get();
    }
}
