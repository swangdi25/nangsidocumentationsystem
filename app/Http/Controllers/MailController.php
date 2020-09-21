<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMailable;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function sendmail(Request $request)
    {
        $user = Auth::user();

          $details = array(
            'subject' => $request->subject,
            // 'title' => 'test subject',
            'body' => $request->message,
            'name' => $user->name,
            'designation' => $user->designation,
            'email' => $user->email,
            'to' => $request->emailid,
            'url' => $request->attachment,
            'filename' => $request->filename
          );

       // \Mail::to($request->emailid)->send(new SendMailable($details));

       \Mail::send('emails.mail',$details,function($message) use ($details) {

            $message->to($details['to'])->subject($details['subject']);
            $message->from('nds@mohca.gov.bt',$details['email'].' via ');
            //$message->attach($details['url'],['mime' => 'application/pdf']);
           
       });

        return redirect('/incoming')->with('alert', 'Email successfully sent!');

       // return view('emails.mail',compact('details'));

    }

    //compose email.
    public function compose(Request $request) {
        
        $url = $request->filelink;
        $email = $request->emailto;
        $subject = $request->lsubject;
        $filename = $request->filename;

        return view('pages.sendemail',['url'=>$url,'email' => $email,'subject' => $subject,'filename' => $filename]);
    }
}
