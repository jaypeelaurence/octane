<?php

namespace App;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $body;

    function __construct($body){
        $this->body = $body;
    }

    public function build(){
    }
    
    public function newAccount($subject){
        return $this->subject($subject)->view('email.new-account');
    }

    public function forgotPassword(){
        return $this->view('email.forgot-password');
    }
}
