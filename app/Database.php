<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

abstract class Database extends Model
{
  	public function create($table, $data = ""){
		$query = DB::table($table);
		$query->insert($data);
		return DB::getPdo()->lastInsertId();
    }

    public function read($table, $condition = "", $data = ""){
		$query = DB::table($table);

		if($condition){
			foreach($condition as $method){
				$setValue = array();

				foreach($method[1] as $getValue){
					$setValue[] = $getValue;
				}

				$query->$method[0](...$setValue);
			}
		}

		return $query->get();
    }

    public function edit($table, $condition, $data){
		// $query = DB::table($table);
		// print_r($condition); exit;

		// return $query->update(..$setValue);
    }

    public function remove($table, $condition){
		$query = DB::table($table);

		foreach($condition as $method){
			$setValue = array();

			foreach($method[1] as $getValue){
				$setValue[] = $getValue;
			}

			$query->$method[0](...$setValue);
		}

		return $query->delete();
    }
}