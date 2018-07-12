<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

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

        $accountId = $this->query->table('esme_credential');
        $accountId->select('system_id','allowed_sender_ids');
        $accountId->where('esme_credential.id', $request->account);
        $accountId->get();

        $senderId = explode("|", "date|".$accountId->get()[0]->allowed_sender_ids, -1);

        $select[] = DB::raw("SUBSTRING(transactions.date_time_created, 1, 10) AS date");

        foreach($senderId as $value){
            if($value != 'date'){
                $select[] = DB::raw("(CASE WHEN transactions.source_addr = '$value' THEN COUNT(transactions.source_addr) END) as '$value'");
            }
        }

        $mysql = $this->query->table('transactions');
        $mysql->select($select);
        $mysql->where('esme_credential_id', $request->account);
        $mysql->groupBy(DB::raw("DATE_FORMAT(transactions.date_time_created, '%Y-%m-%d')"));

        return [
                'accountName' => $accountId->get()[0]->system_id,
                'column' => $senderId,
                'data' => $mysql->get()
            ];
    }

    public function generateReport($transactions){
        $cols = "";

        foreach ($transactions->column as $value){
            $cols .= $value . ",";
            $column[] = $value;
        }

        $line[] = $cols;

        foreach ($transactions->data as $value){
            $row = "";

            foreach($column as $field){
                $row .= $value->$field . ",";
            }
            
            $line[] = $row;
        }

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
        );

        $path = public_path('/files/report.csv');

        $file = fopen($path, "w");

        foreach ($line as $list){
            fputcsv($file,explode(',',$list));
        }

        fclose($file);

        return response()->download($path, "octane-".$transactions->accountName . "-" . time().".csv", $headers);
    }
}
