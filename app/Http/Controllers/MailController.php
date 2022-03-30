<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\EmailTemplate;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Auth;

class MailController extends Controller
{

    public function mailTemplate()
    {
        $myEmail = 'vu.nguyen@wolfsolutions.vn';
        $details = [
            'title' => 'Mail Demo from ItSolutionStuff.com',
            'url' => 'https://www.itsolutionstuff.com'
        ];
  
        Mail::to($myEmail)->send(new EmailTemplate($details));
   
        dd("Mail Send Successfully");
    }

    public function txt_mail(Request $request)
    {
        $info = array(
            'name' => "Admin"
        );
        $data = array('email'=>$request->input('email'), 'name'=>$request->input('username'));
        Mail::send(['data' => $data,], $info, function ($message) use ($data)
        {
            $message->to('vu.nguyen@wolfsolutions.vn','Justin')         //$data['email'], $data['name'])
                ->subject('Test Email Notifications');
            $message->setBody('This is an automatically mail for active account. Please click in the link below to active your account. Thank you!');
            $message->from('sender@example.com', 'Admin');
            return $message;
        });
        
        //echo "Successfully sent the email";
    }

    public function html_mail(Request $request)
    {
        $info = array(
            'name' => "Alex"
        );
        $data = array('email'=>$request->input('email'), 'name'=>$request->input('username'));
        Mail::send('mail', $info, function ($message) use ($data)
        {
            $message->to('vu.nguyen@wolfsolutions.vn','Justin') 
                ->subject('HTML test eMail from W3schools.');
                $message->setBody('This is a test email');
            $message->from('karlosray@gmail.com', 'Alex');
        });
        echo "Successfully sent the email";
    }

    public function attached_mail(Request $request)
    {
        $info = array(
            'name' => "Alex"
        );
        $data = array('email'=>$request->input('email'), 'name'=>$request->input('username'));
        Mail::send('mail', $info, function ($message) use ($data)
        {
            $message->to('alex@example.com', 'w3schools')
                ->subject('Test eMail with an attachment from W3schools.');
                $message->setBody('This is a test email');
            $message->attach('D:\laravel_main\laravel\public\uploads\pic.jpg');
            $message->attach('D:\laravel_main\laravel\public\uploads\message_mail.txt');
            $message->from('karlosray@gmail.com', 'Alex');
        });
        echo "Successfully sent the email";
    }
}