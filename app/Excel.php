<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

// use Vendor\PhpOffice\PhpSpreadsheet;

class excel extends Model{
    function __construct(){
		// $this->load = new PhpSpreadsheet;
	}

	public function load($data){
		return $data;
	}
}