<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validate extends Model
{
    public function addUser($request){
    	print_r($request->all()); exit;

       	return TRUE;
    }

    public function editUser(){

    }
}
