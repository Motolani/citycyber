<?php

namespace App\Http\Controllers;
use Exception;
use App\Notifications\General;
use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    public function sendMail(){
        $emails =[
            "olalerephilip@gmail.com"
        ];
        $message = "This is Just a test";
        $subject = "subject";
        $greeting = "greetings";
        $path = "/Users/oatek/Documents/oatekcitycyber/test.txt";
        try {
            $details = [
            'subject' => $subject,
            'greetings' => $greeting,
            'message' => $message,
            'path'=> $path
            ];
            \Illuminate\Support\Facades\Notification::route('mail', $emails)
            ->notify(new  General($details));
            // $sentLog = new \App\Sent_email_log([
            //     'title'=>$title,
            //     'status'=>"Sent"
            // ]);
            // $sentLog->save();
            dd("sent");
        }
        catch (Exception $exception){
            // $sentLog = new \App\Sent_email_log([
            //     'title'=>$title,
            //     'status'=>0
            // ]);
            // $sentLog->save();
            // dd($exception);

            
        }
    }
}
