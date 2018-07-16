<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErrorCode extends Model
{
    function __construct($code = null){
    	$error = [
    		'100' => ['code' => 100,'message' => "Page not found"],
            '101' => ['code' => 101 ,'message' => "Website is down"],
    		'103' => ['code' => 103	,'message' => "Page restricted"],
    	];

    	if(array_key_exists($code,$error)){
	    	return $this->error = $error[$code];
    	}else{
    		return $this->error = $error[100];
    	}
    }

    public function code(){
    	return $this->error['code'];
    }

    public function message(){
    	return $this->error['message'];
    }
}