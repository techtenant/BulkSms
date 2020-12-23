<?php

namespace App\Http\Controllers;

use App\Traits\MessageTrait;
use Illuminate\Http\Request;

class SmsController extends Controller
{
use MessageTrait;
    public function tumaText()
    { 
        // $this->sendMessage($data);
        $this->smsNotify();
    }
}
