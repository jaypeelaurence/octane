<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    function __construct(){
    	// $this->query = DB::connection('mysql2');
    	$this->query = DB::connection('mysql2');
    }

    public function listAccount(){
		return $this->query->table('esme_credential')->select('id','system_id')->get();
    }

    public function transAccount($request){
    	$start = explode("/",$request->start);
    	$end = explode("/",$request->end);

    	$startDate = $start[2] . "-" . $start[0] . "-" . $start[1] . " 00:00:00";
    	$endDate = $end[2] . "-" . $end[0] . "-" .$end[1]." 24:59:59";

		$mysql = $this->query->table('transactions');
    	$mysql->select(
    		DB::raw("SUBSTRING(transactions.date_time_created, 1, 10) as date"),
    		DB::raw("count(transactions.id) as total")
    		// DB::raw('transactions.source_addr as senderId')
    	);

    	$mysql->leftJoin('prefix', 'transactions.prefix_id', '=', 'prefix.id');
    	$mysql->leftJoin('esme_credential', 'transactions.esme_credential_id', '=', 'esme_credential.id');
    	// $mysql->where('transactions.esme_credential_id', $request->account);
		$mysql->groupBy(DB::raw("DATE_FORMAT(transactions.date_time_created, '%Y-%m-%d')"));

    	return $mysql->get();
    }
}
