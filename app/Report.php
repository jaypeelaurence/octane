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

    public function listAccount($name = NULL){
        if($name){
            return $this->query->table('esme_credential')->select('id','system_id')->where('system_id', $name)->orderBy('system_id', 'asc')->get();
        }else{
            return $this->query->table('esme_credential')->select('id','system_id')->orderBy('system_id', 'asc')->get();
        }
    }

    public function listSender($idList){
        $accounts = explode("|", $idList, -1);

        if(count($accounts) > 0){
            foreach($accounts as $key => $id){
                $accountId = $this->query->table('esme_credential');
                $accountId->select('allowed_sender_ids');
                $accountId->where('esme_credential.id', $id);
                $accountId->get();
                $senderIds = explode("|", utf8_encode($accountId->get()[0]->allowed_sender_ids), -1);

                foreach($senderIds as $senderId){
                    $list[] = $senderId;
                }
            }

            return $list;
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

        $column[] = date('Y-m-d', strtotime($startDate));
        $total[date('Y-m-d', strtotime($startDate))] = 0;

        for($i=1; $i <= $dateRange; $i++){
            $date[] = [
               'start' => date('Y-m-d', strtotime("+$i day" . $startDate)) . " 00:00:01",
               'end' => date('Y-m-d', strtotime("+$i day" . $startDate)) . " 23:59:59"
            ];

            $column[] = date('Y-m-d', strtotime("+$i day" . $startDate));

            $total[date('Y-m-d', strtotime("+$i day" . $startDate))] = 0;
        }

        $formAccount = explode("|",$request->account,-1);

        foreach($formAccount as $value){
            $query = $this->query->table('esme_credential');
            $query->select('system_id','allowed_sender_ids');
            $query->where('esme_credential.id', $value);
            $query->get();

            $accountId[] = $query->get()[0]->system_id;

            $senderId = [explode("|", utf8_encode($query->get()[0]->allowed_sender_ids), -1)];
        }

        $stringAccount = '';

        foreach ($accountId as $value) {
            $stringAccount .= "'".$value."',";
        }

        $listAccount =  substr($stringAccount, 0, -1);

        $i = 0;

        foreach($date as $value){
            $where = "account in (" . $listAccount . ") AND date_time_created BETWEEN '" . $value['start'] . "' AND '" . $value['end'] . "'";

            $query = $this->query->table('v10_outbound_txn');
            $query->select(['sender_id', DB::raw("COUNT(id) as count")]);
            $query->whereRaw($where);
            $query->groupBy('sender_id');
            $query->orderBY('sender_id', 'asc');

            foreach($query->get() as $value){
                $result[$column[$i]][strtolower($value->sender_id)] = $value->count;

                $total[$column[$i]] = $value->count;
            }

            ++$i;
        }

        foreach ($senderId[0] as $senderName){
            foreach ($column as $day) {
                $data[$senderName][$day] = 0;

                if(isset($result) && count($result) > 0 && array_key_exists($day,$result) && array_key_exists($senderName,$result[$day])){
                    $data[$senderName][$day] = $result[$day][$senderName];
                }
            }
        }

        return [
            'accountName' => $accountId,
            'column' => $column,
            'data' => ['total' => $total, 'row' => $data]
        ];
    }

    public function transSender($request){
        $start = explode("/",$request->start);
        $end = explode("/",$request->end);

        $startDate = $start[2] . "-" . $start[0] . "-" . $start[1];
        $endDate = $end[2] . "-" . $end[0] . "-" .$end[1];

        $dateRange = date_diff(date_create($startDate), date_create($endDate))->d;

        $date[] = [
            'start' => $startDate . " 00:00:01",
            'end' => $startDate . " 23:59:59"
        ];

        $row[] = date('Y-m-d', strtotime($startDate));

        for($i=1; $i <= $dateRange; $i++){
            $date[] = [
               'start' => date('Y-m-d', strtotime("+$i day" . $startDate)) . " 00:00:01",
               'end' => date('Y-m-d', strtotime("+$i day" . $startDate)) . " 23:59:59"
            ];

            $row[] = date('Y-m-d', strtotime("+$i day" . $startDate));
        }

        $column = [
            1 => 'GLOBE',
            2 => 'Smart',
            3 => 'Others',
            4 => 'SUN',
            5 => 'other2'
        ];

        foreach ($column as $brand) {
           $total[$brand] = 0;
        }

        $formAccount = explode("|",$request->account,-1);

        foreach($formAccount as $value){
            $query = $this->query->table('esme_credential');
            $query->select('system_id','allowed_sender_ids');
            $query->where('esme_credential.id', $value);
            $query->get();

            $accountId[] = $query->get()[0]->system_id;

            $senderId = [explode("|", utf8_encode($query->get()[0]->allowed_sender_ids), -1)];
        }

        $stringAccount = '';

        foreach ($accountId as $value) {
            $stringAccount .= "'".$value."',";
        }

        $listAccount =  substr($stringAccount, 0, -1);

        $i = 0;

        if($request->sender == "All Sender Id"){
            foreach($date as $value){
                $start = $value['start'];
                $end = $value['end'];
                foreach($column as $key => $brand){
                    $where = "account in (" . $listAccount . ") AND date_time_created BETWEEN '" . $start . "' AND '" . $end . "' AND prefix_id = " . $key;

                    $query = $this->query->table('v10_outbound_txn');
                    $query->select(['prefix_id', DB::raw("COUNT(id) as count")]);
                    $query->whereRaw($where);
                    $query->groupBy('prefix_id');
                    $query->orderBY('prefix_id', 'asc');

                    foreach($query->get() as $value){
                        $result[$row[$i]][$brand] = $value->count;

                        $total[$brand] +=  $value->count;
                    }
                }

                ++$i;
            }
        }else{
            foreach($date as $value){
                $start = $value['start'];
                $end = $value['end'];
                foreach($column as $key => $brand){
                    $where = "account in (" . $listAccount . ") AND date_time_created BETWEEN '" . $start . "' AND '" . $end . "' AND prefix_id = " . $key . " AND sender_id = '" . $request->sender . "'";

                    $query = $this->query->table('v10_outbound_txn');
                    $query->select(['prefix_id', DB::raw("COUNT(id) as count")]);
                    $query->whereRaw($where);
                    $query->groupBy('prefix_id');
                    $query->orderBY('prefix_id', 'asc');

                    foreach($query->get() as $value){
                        $result[$row[$i]][$brand] = $value->count;

                        $total[$brand] += $value->count;
                    }
                }

                ++$i;
            }
        }

        foreach($row as $date){
            foreach ($column as $brand) {
                $data[$date][$brand] = 0;

                if(isset($result) && count($result) > 0 && array_key_exists($date,$result) && array_key_exists($brand,$result[$date])){
                    $data[$date][$brand] = $result[$date][$brand];
                }
            }
        }

        return [
            'accountName' => $accountId,
            'senderName' => $request->sender,
            'column' => $column,
            'data' =>  ['total' => $total, 'row' => $data]
        ];
    }

    public function generateReport($transactions){
        $cols = ",";

        foreach ($transactions->column as $value){
            $cols .= $value . ",";
            $column[] = $value;
        }

        $line[] = $cols;

        foreach ($transactions->data->row as $key => $row){
            $data = $key . ",";
            foreach ($row as $value){
                $data .= $value . ",";
            }

            $line[] = $data;
        }

        $total = "total,";

        foreach ($transactions->data->total as $value){
            $total .= $value . ",";
        }

        $line[] = $total;

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

        $filename = implode(" ", $transactions->accountName);

        if($transactions->type == "sender"){
            $filename .= "_" . $transactions->senderName;
        }

        $filename .= "_" . $transactions->dateRange[0] . "-" . $transactions->dateRange[0];

        return response()->download($path, str_replace("/","", $filename) . ".csv", $headers);
    }

    public function test(){
        $test = DB::connection('mysql3');

        return $list;
    }
}