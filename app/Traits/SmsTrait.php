<?php

namespace App\Traits;

use AfricasTalking\SDK\AfricasTalking;
use Exception;
use Illuminate\Support\Facades\Session;

trait SmsTrait
{
    public function sendMessage($message, $phone_number){

        $username = config('credentials.username');
        $apiKey = config('credentials.api_key');

        $AT = new AfricasTalking($username, $apiKey);

        
        $sms = $AT->sms();

        try{
            $response = $sms->send(array(
                "to" => $phone_number,
                "from" => '',
                "message" => $message,
            ));
            
            Session::flash('success', 'Message sent successfully!');
        
        }catch(Exception $e){
            Session::flash('error');
            return redirect()->route('message.index ');

        }
            
    }
}


