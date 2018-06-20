<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

abstract class Database extends Model
{

  	public function create($table, $data){
		$query = DB::table($table);
		$query->insert($data);
		return DB::getPdo()->lastInsertId();
    }

    public function read($table, $condition = ''){
		$query = DB::table($table);

		if($condition){
			foreach($condition as $method){
				echo $method;
			}
			exit;
			// $query->$condition()[0];
		}

		return $query->get();
    }

  //   public function edit($table, $condition, $data){
		// $query = DB::table($table);
		// print_r($condition); exit;
  //   }

  //   public function delete($table, $data){
		// $query = DB::table($table);
		// $query->insert();
  //   }
}