<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\User;

class Account extends Model{
    function __construct(){
        $this->user = new User();
    }

    public function viewUser($uid = null){
    	if($uid){
            return $this->user::where('id', $uid)->get();
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
}