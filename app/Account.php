<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Email;

class Account extends Model{
    function __construct(){
        $this->user = new User();
    }

    public function viewUser($uid = null, $strUser = null){
    	if($uid){
            return $this->user::where('id', $uid)->get();
    	}elseif($strUser){
            $where = "firstname LIKE '%" . strtolower($strUser) . "%' OR lastname LIKE '%" . strtolower($strUser) . "%' OR '" . strtolower($strUser) ."' LIKE CONCAT(firstname,'%') OR '" . strtolower($strUser) ."' LIKE CONCAT('%',lastname,'%')";

            return $this->user::whereRaw($where)->get();
        }else{
            return $this->user::orderBy('id', 'asc')->get();
    	}
    }
    
    public function addUser($getForm){
        foreach($getForm as $key => $field){
            if($field != null){
                $values[$key] = $field;
            }
        }

        $values['password'] =  md5('jaypeepogi');
        $values['remember_token'] =  md5(time().rand(0,100));       
        
        $addUser = $this->user::create($values);

        $body = new \stdClass();
        $body->to = $getForm['firstname'] . " " . $getForm['lastname'];
        $body->url = base64_encode("type=new&uid=" . $addUser->id . "&time=" . time());
        $body->subject = "Welcome to Adspark | Octane";

        $request = new Email($body);

        DB::table('sessions')->insert(['hash' => $body->url]);

        Mail::to($getForm['email'])->send($request->newAccount($body->subject));

        return $addUser->id;
    }

    public function editUser($getForm, $uid){
        $editUser = $this->user::find($uid->id);

        foreach($getForm as $key => $field){
            if($field != null){
                if($key == "password"){
                    $values[$key] = md5($field);
                }else{
                    $values[$key] = $field;
                }
            }
        }

        $editUser->update($values);

        return $editUser->id;
    }

    public function deleteUser($uid){
        $deleteUser = $this->user::find($uid->id);

        return $deleteUser->delete();
    }

    public function changePass($getForm, $uid){
        $editUser = $this->user::find($uid);
        $editUser->update(['password' => md5($getForm)]);

        return $this->user::find($uid);
    }
}