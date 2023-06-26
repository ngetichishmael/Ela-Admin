<?php

namespace App\Helpers;

use AfricasTalking\SDK\AfricasTalking;

class SMS
{
  public function __invoke($phone_number, $message)
  {
    $AT       = new AfricasTalking('Nyakaja', '6ee0de9e828ae646c80a221dd76181f196dff34cb3dd2177121660035ecb7e32');
    $sms      = $AT->sms();
    $sms->send([
      'from' => 'Nyakanja',
      'to'      => $phone_number,
      'message' => $message
    ]);
  }
}
