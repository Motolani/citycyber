<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends BaseController
{

    public function __construct()
    {
        //Add this line to call Parent Constructor from BaseController
        // parent::__construct();

        $this->middleware('auth');
    }

    public function createNotificationForm()
    {
        
        $staff = \App\User::all();
        // dd($staff);

        return view("admin.notification.createNotification", compact(['staff']));

    }


    public function createNotification(Request $request){

        $message = new \App\Notification([
            "title"=>$request->title,
            "message"=>$request->message,
            "type"=>$request->type,
            "staff_id"=>$request->staff_id,
            "senderName"=>Auth::user()->firstname." ".Auth::user()->lastname,
            "senderEmail"=>Auth::user()->email,
            "senderId"=>Auth::user()->id,
        ]);
        if($message->save()){
            $staff = \App\User::all();
            alert()->success('Message Sent Successfully', '');
            return view("admin.notification.createNotification", compact(['staff']))->with('status','message Sent Successfully');
        }else{
            alert()->error('Could not Send Mail', 'Error');
            return view("admin.notification.createNotification", compact(['staff']))->with('status','message Could not be sent');
        }

        $customers = \App\Customer::all();

        $branch_id = Auth::user()->branchId;
        $banks = \App\Bank_Account::all();
        $pos = \App\Pos::all();
        
        
    }

    public function readNotif(Request $request,$id){

        $user_id = Auth::id();
        $count = \App\Notification::where('staff_id',$user_id)->orWhere('staff_id',null)->count('id');
        $notif = DB::select( DB::raw("select * from notifications where id = '$id' and (staff_id='$user_id' or staff_id is null)") );
        // select * from notifications where id = 4 and (staff_id=4 or staff_id = null)
        $total = $count;
        
        
        return view('admin.notification.readmail',compact(['notif','total']));
    }


    public function inbox(Request $request){

        $notif = \App\Notification::where('staff_id',Auth::id())->orWhere('staff_id',null);
        $notif = $notif->get();
        $total = $notif->count('id');
        return view('admin.notification.inbox',compact(['notif','total']));
    }
}
