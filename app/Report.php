<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    function __construct(){
        $this->query = DB::connection('mysql2'); //dummy_db
    }

    public function listAccount(){
        return $this->query->table('esme_credential')->select('id','system_id')->get();
    }

    public function listSender($id){
        $accountId = $this->query->table('esme_credential');
        $accountId->select('allowed_sender_ids');
        $accountId->where('esme_credential.id', $id);
        $accountId->limit(1000000);
        $accountId->get();

        if(count($accountId->get()) != 0){
            $senderId = explode("|", $accountId->get()[0]->allowed_sender_ids, -1);

            return $senderId;
        }else{
            return redirect('error/100');
        }
    }

    public function transAccount($request){
        $start = explode("/",$request->start);
        $end = explode("/",$request->end);

        $startDate = $start[2] . "-" . $start[0] . "-" . $start[1];
        $endDate = $end[2] . "-" . $end[0] . "-" .$end[1];

        $dateRange = date_diff(date_create($startDate), date_create($endDate))->d;

        $date[] = [
            'start' => $startDate . " 00:00:01",
            'end' => $startDate . " 23:59:59"
        ];

        $column = ['sender id',$startDate];

        for($i=1; $i <= $dateRange; $i++){
            $date[] = [
               'start' => date('Y-m-d', strtotime("+$i day" . $startDate)) . " 00:00:01",
               'end' => date('Y-m-d', strtotime("+$i day" . $startDate)) . " 23:59:59"
            ];

            $column[] = date('Y-m-d', strtotime("+$i day" . $startDate));
        }

        $accountId = $this->query->table('esme_credential');
        $accountId->select('system_id','allowed_sender_ids');
        $accountId->where('esme_credential.id', $request->account);
        $accountId->get();

        $senderId = explode("|", $accountId->get()[0]->allowed_sender_ids, -1);
  
        $select[] = DB::raw("transactions.source_addr AS 'sender id'");

        foreach($senderId as $value){
            foreach($date as $eachDay){ 
                $dayStart = $eachDay['start'];
                $dayEnd = $eachDay['end'];
                $select[] = DB::raw("(CASE WHEN transactions.date_time_created BETWEEN '$dayStart' AND '$dayEnd' THEN COUNT(transactions.id) END) as '" . substr($dayStart, 0, -9) . "'");
            }
        }

        $mysql = $this->query->table('transactions');
        $mysql->select($select);
        $mysql->where('esme_credential_id', $request->account);
        $mysql->groupBy(DB::raw("transactions.source_addr"));

        return [
                'accountName' => $accountId->get()[0]->system_id,
                'column' => $column,
                'data' => $mysql->get()
            ];
    }

    public function transSender($request){
        $start = explode("/",$request->start);
        $end = explode("/",$request->end);

        $startDate = $start[2] . "-" . $start[0] . "-" . $start[1] . " 00:00:00";
        $endDate = $end[2] . "-" . $end[0] . "-" .$end[1] . " 24:59:59";

        $accountId = $this->query->table('esme_credential');
        $accountId->select('system_id');
        $accountId->where('esme_credential.id', $request->account);

        $prefix = $this->query->table('prefix');
        $prefix->select('id', 'name');

        $select[] = DB::raw("SUBSTRING(transactions.date_time_created, 1, 10) AS date");

        $network[] = "date";

        foreach($prefix->get() as $value){
            $prefix_id = $value->id;
            $prefix_name = $value->name;
            $select[] = DB::raw("(CASE WHEN transactions.prefix_id = '$prefix_id' THEN COUNT(transactions.prefix_id) END) as '$prefix_name'");

            $network[] = $value->name;
        }

        $mysql = $this->query->table('transactions');
        $mysql->select($select);
        $mysql->where([
            ['esme_credential_id', $request->account],
            ['source_addr', $request->sender]
        ]);
        $mysql->whereBetween('date_time_created', array($startDate, $endDate));
        $mysql->groupBy(DB::raw("DATE_FORMAT(transactions.date_time_created, '%Y-%m-%d')"));

        return [
            'accountName' => $accountId->get()[0]->system_id,
            'senderName' => $request->sender,
            'column' => $network,
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

        $filename = $transactions->accountName;

        if($transactions->type == "sender"){
            $filename .= "_" . $transactions->senderName;
        }

        $filename .= "_" . $transactions->dateRange[0] . "-" . $transactions->dateRange[0];

        return response()->download($path, str_replace("/","", $filename) . ".csv", $headers);
    }
}