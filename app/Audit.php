<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Audit extends Model
{
	private function logType($code){
    	$type =  [
    		'100' => "Account:",
    		'101' => "Account - login:",
        '102' => "Account - logout:",
        '103' => "Account - forgot password:",
    		'104' => "Account - change password:",
    		'200' => "User:",
    		'201' => "User - update:",
    		'202' => "User - change password:",
    		'203' => "User - deleted:",
    	];

    	return $type[$code];
	}

  public function log($type, $activity, $user = null){
     	DB::table('audit')->insert([
     		'date_logged' => date('Y-m-d H:i:s'),
     		'user' => $user == null ? Auth::user()->email : $user,
		    'activity' => $this->logType($type) . $activity,
     	]);
  }
}
