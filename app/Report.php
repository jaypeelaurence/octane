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
            $where = "account LIKE '%" . $name . "%'"; 

            return $this->query->table('accounts')->select('id', 'account')->whereRaw($where)->orderBy('account', 'asc')->get();
        }else{
            return $this->query->table('accounts')->select('id', 'account')->orderBy('account', 'asc')->get();
        }
    }

    public function listSender($idList, $strSndr = NULL){
        if($idList && $strSndr == NULL){
            $accounts = explode("|", $idList, -1);

            if(count($accounts) != 0){
                foreach($accounts as $id){
                    $accountId = $this->query->table('accounts');
                    $accountId->select('account', 'allowed_sender_ids');
                    $accountId->where('id', $id);
                    $accountId->get();

                    $senderIds = explode("|", utf8_encode($accountId->get()[0]->allowed_sender_ids), -1);

                    foreach($senderIds as $senderId){
                        $list[] = [$accountId->get()[0]->account, $senderId];
                    }
                }

                return $list;
            }else{
                return redirect('error/100');
            }
        }elseif($idList && $strSndr){
            $accounts = explode("|", $idList, -1);

            if(count($accounts) != 0){
                foreach($accounts as $id){
                    $where = "id = " . $id . " AND allowed_sender_ids LIKE '%" . $strSndr . "%'";;

                    $accountId = $this->query->table('accounts');
                    $accountId->select('account', 'allowed_sender_ids');
                    $accountId->whereRaw($where);
                    // $accountId->where('id', $id);
                    $accountId->get();

                    // return [$where];

                    return $accountId->get();

                    $senderIds = explode("|", utf8_encode($accountId->get()[0]->allowed_sender_ids), -1);

                    foreach($senderIds as $senderId){
                        $list[] = [$accountId->get()[0]->account, $senderId];
                    }
                }

                return $list;
            }else{
                return redirect('error/100');
            }
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

        $column[] = date('Y-m-d', strtotime($startDate));
        $total['row'][date('Y-m-d', strtotime($startDate))] = 0;

        for($i=1; $i <= $dateRange; $i++){
            $column[] = date('Y-m-d', strtotime("+$i day" . $startDate));

            $total['row'][date('Y-m-d', strtotime("+$i day" . $startDate))] = 0;
        }

        $formAccount = explode("|", $request->account,-1);

        foreach($formAccount as $value){
            $query = $this->query->table('accounts');
            $query->select('account','allowed_sender_ids');
            $query->where('id', $value);
            $query->get();

            $accountId[] = $query->get()[0]->account;

            $senderList = explode("|", utf8_encode($query->get()[0]->allowed_sender_ids), -1);

            foreach($senderList as $value){
                $pickedList[] = $query->get()[0]->account . ' - ' . $value;

                $total['col'][$query->get()[0]->account . ' - ' . $value] = 0;
            }
        }

        foreach($column as $date){
            foreach ($pickedList as $value) {
                $start = $date . " 00:00:01";
                $end = $date . " 23:59:59";

                $pickedId = explode(' - ',$value);

                $where = "account = \"" . $pickedId[0] . "\" AND sender_id = \"" . $pickedId[1] . "\" AND date_time_created BETWEEN '" . $start . "' AND '" . $end . "'";

                $query = $this->query->table('v10_outbound_txn');
                $query->select([DB::raw("COUNT(id) as count")]);
                $query->whereRaw($where);

                $sum = $query->count();

                $result[$date][$value] = $sum;

                $total['row'][$date] += $sum;
                $total['col'][$value] += $sum;
            }
        }

        foreach($pickedList as $row){
            foreach ($column as $day) {
                $data[$row][$day] = 0;

                $data[$row][$day] = $result[$day][$row];
            }
        }

        return [
            'accountName' => $accountId,
            'column' => $column,
            'data' => ['total' => $total, 'count' => $data]
        ];
    }

    public function transSender($request){
        $start = explode("/",$request->start);
        $end = explode("/",$request->end);

        $startDate = $start[2] . "-" . $start[0] . "-" . $start[1];
        $endDate = $end[2] . "-" . $end[0] . "-" .$end[1];

        $dateRange = date_diff(date_create($startDate), date_create($endDate))->d;

        $date[] = date('Y-m-d', strtotime($startDate));
        $total['col'][date('Y-m-d', strtotime($startDate))] = 0;

        for($i=1; $i <= $dateRange; $i++){
            $date[] = date('Y-m-d', strtotime("+$i day" . $startDate));
            $total['col'][date('Y-m-d', strtotime("+$i day" . $startDate))] = 0;
        }

        $column = [
            1 => 'GLOBE',
            2 => 'SMART',
            4 => 'SUN',
            3 => 'Others',
        ];

        foreach ($column as $brand) {
            $total['row'][$brand] = 0;
        }

        if($request->sender == "All Sender ID"){
            $getSender = $request->sender;

            $formAccount = explode("|", $request->account,-1);

            foreach($formAccount as $value){
                $query = $this->query->table('accounts');
                $query->select('account','allowed_sender_ids');
                $query->where('id', $value);
                $query->get();

                $accountId[] = $query->get()[0]->account;

                $senderList = explode("|", utf8_encode($query->get()[0]->allowed_sender_ids), -1);

                foreach($senderList as $value){
                    $pickedList[] = $query->get()[0]->account . ' - ' . $value;
                }
            }
        }else{
            $accountId[] = explode(' => ', $request->sender)[0];
            $getSender = explode(' => ', $request->sender)[1];

            $pickedList[] = str_replace(' => ', ' - ', $request->sender);
        }

        $accountList = "";

        foreach ($accountId as $key => $value) {
            $accountList .= "'" . $value . "',";
        }

        $senderNames = "";

        foreach ($pickedList as $key => $value) {
            $senderNames .= "\"" . explode(' - ',$value)[1] . "\",";
        }

        foreach ($column as $brand) {
            foreach ($date as $day) {
                $start = $day . " 00:00:01";
                $end = $day . " 23:59:59";

                $query = $this->query->table('v10_outbound_txn');

                $where = "prefix_name = '". $brand ."' AND account IN (" . substr($accountList, 0, -1) . ") AND sender_id IN (" . substr($senderNames, 0, -1) . ") AND date_time_created BETWEEN '" . $start . "' AND '" . $end . "'";

                $query->select([DB::raw("COUNT(id) as count")]);
                
                $query->whereRaw($where);

                $result[$brand][$day] = $query->count();

                $total['row'][$brand] += $query->count();
                $total['col'][$day] += $query->count();
            }
        }

        foreach ($date as $day) {
            foreach ($column as $brand) {
                $data[$day][$brand] = 0;

                $data[$day][$brand] = $result[$brand][$day];
            }
        }

        return [
            'accountName' => $accountId,
            'senderName' => $getSender,
            'column' => $column,
            'data' =>  ['total' => $total, 'count' => $data]
        ];
    }

    public function generateReport($transactions){
        $cols = ",";

        foreach ($transactions->column as $value){
            $cols .= $value . ",";
            $column[] = $value;
        }

        $line[] = $cols.'Total';

        foreach ($transactions->data->count as $key => $row){
            $data = $key . ",";
            foreach ($row as $value){
                $data .= $value . ",";
            }

            $line[] = $data . $transactions->data->total->col->$key;
        }

        $total = "Total,";

        foreach ($transactions->data->total->row as $key => $value){
            $total .= $value . "," ;
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
}