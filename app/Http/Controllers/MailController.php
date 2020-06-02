<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class MailController extends Controller
{
    //

    public function sendmail()
    {
      $data['title'] = "This is test email.";
 
      Mail::send('emails.mail', $data, function($message) {

          $message->to('swangdi@mohca.gov.bt', 'Sangay Wangdi')
                  ->subject('Email Verification');
      });

      // if (Mail::failures()) {
      //    return response()->Fail('Sorry! Please try again latter');
      //  }else{
      //    return response()->success('Great! Successfully send in your mail');
      //  }

      return 'success';

    }
    
}
