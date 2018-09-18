<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Account;

class Audit extends Model
{
    function __construct(){
        $this->query = DB::table('audit');
        $this->account = new Account;
    }

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
            '300' => "Report",
            '301' => "Report - generate",
            '400' => "Audit",
    		'401' => "Audit - generate",
    	];

    	return $type[$code];
	}

    public function log($type, $activity, $user = null){
        $this->query->insert([
            'date_logged' => date('Y-m-d H:i:s'),
            'user' => $user == null ? Auth::user()->email : $user,
            'activity' => $this->logType($type) . $activity,
        ]);
    }

    public function getLog($request = null){
        $dateRange = [
            date('Y-m-d', strtotime(date('Y-m-d') . ' -3 months')),
            date('Y-m-d')
        ];

        $accountName = null;

        if($request == NULL){
            $result =  $this->query->limit(30)->orderBy('id','desc')->get();
        }else{
            if($request->start && $request->end){
                $start = explode('/',$request->start);
                $end = explode('/',$request->end);

                $date = [
                    "start" =>  $start[2] . "-" . $start[0] . "-" . $start[1] . " 00:00:00",
                    "end"   =>  $end[2] . "-" . $end[0] . "-" . $end[1] . " 00:00:00"
                ];

                $dateRange = [
                    $start[2] . "-" . $start[0] . "-" . $start[1],
                    $end[2] . "-" . $end[0] . "-" . $end[1]
                ];

                $whereRaw[] = "date_logged BETWEEN '" . $date['start'] . "' AND '". $date['end'] . "'";
            }

            if($request->username){
                $whereRaw[] = "user = '" .$this->account->viewUser(explode(" | ",$request->username)[0])[0]->email . "'";

                $accountName = explode(" | ",$request->username)[1];
            };

            $result =  $this->query->whereRaw(implode(' AND ',$whereRaw))->limit(30)->orderBy('id','desc')->get();
        }

        $column = [
            'ID',
            'User',
            'Activity',
            'Date Logged'
        ];

        return [
                'dateRange'     => $dateRange,
                'accountName'   => $accountName,
                'column'        => $column,
                'data'          => $result,
            ];
    }
}
