<?php
namespace App\Traits;

use App\User;
use App\Part;
use App\Order;
use AfricasTalking\SDK\AfricasTalking;



trait MessageTrait
{
  protected $username;
  protected $apiKey;
  protected $from;
  
  public function __construct()
  {
    $this->apiKey = env('AT_API_KEY','KEY'); // use your sandbox app API key for development in the test environment
    $this->username = env('AT_USERNAME'); // use 'sandbox' for development in the test environment
    $this->from     = env('mCarFix');
    
    //To do
    //Kindly ensure you use the env key set in the construct function
    //The current set up is due to the Guzzle issue from AfricasTalking api
  }



    public function smsNotify()
  {
    $apiKey = env('AT_API_KEY','KEY');
    $username = env('AT_USERNAME');
    $AT = new AfricasTalking($username, $apiKey);
    $sms      = $AT->sms();
    $numbers = '726984260';
    $number = '+254'.$numbers;
    $result   = $sms->send([
      'from'    => 'Grub',
      'to'      => $number,
      'message' => 'Dear Bernard Arum Ochieng, your defaulting details were forwarded to Ngandas debt recovery, You have been listed as a defaulter by Techtenant Laptops. Details to be posted on buyer beware'
    ]);
    dd($result);
  }
  
  


  public function notifyReminder($data)
  {
    $apiKey = env('AT_API_KEY','KEY');
    $username = env('AT_USERNAME');
    $AT = new AfricasTalking($username, $apiKey);
    //Get user details
    
    $sms      = $AT->sms();
    //$number = '+'.$data['payer_number'];
    $number ='+254'.(substr(($data),1)) ;
    $result   = $sms->send([
      'from'    => 'mCarFix',
      'to'      => $number,
      'message' => 'You are reminded today to update your car mileage'
    ]);
  }

  public function notifyTrial($data)
  {
    $apiKey = env('AT_API_KEY','KEY');
    $username = env('AT_USERNAME');
    $AT = new AfricasTalking($username, $apiKey);
    //Get user details
    
    $sms      = $AT->sms();
    //$number = '+'.$data['payer_number'];
    $number ='+254'.(substr(($data),1)) ;
    $result   = $sms->send([
      'from'    => 'mCarFix',
      'to'      => $number,
      'message' => 'You have subscribed free trial for three days.'
    ]);
  }
 

  
  
  
  public function resetPassword($user)
  {
    $apiKey = env('AT_API_KEY','KEY');
    $username = env('AT_USERNAME');
    
    $AT = new AfricasTalking($username, $apiKey);
    $sms = $AT->sms();
    $number ='+254'.(substr(($user->email),1)) ;
    $result   = $sms->send([
      'from'    => 'mCarFix',
      'to'      => $number,
      'message' =>'Your MCarFix Password reset code is:'.' '.$user->token.''
    ]);
  }
  

public function adminBroadcast($phones, $message)
  {
    $apiKey = env('AT_API_KEY','KEY');
    $username = env('AT_USERNAME');
    
    $AT = new AfricasTalking($username, $apiKey);
    $sms = $AT->sms();
    foreach ($phones as $key => $send) {
      $number ='+254'.(substr(($send->contact),1)) ;
    $result   = $sms->send([
      'from'    => 'mCarFix',
      'to'      => $number,
      'message' =>$message
    ]);
  }
    }
    
}