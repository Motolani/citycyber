<?php

namespace App\Http\Controllers;

use App\Notification;
use App\NotificationList;
use App\Office;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class NotificationController extends BaseController
{

    public function __construct()
    {
        //Add this line to call Parent Constructor from BaseController
        // parent::__construct();

        // $this->middleware('auth');
    }

    public function createNotificationForm()
    {

        $staff = \App\User::all();
        // dd($staff);

        return view("admin.notification.createNotification", compact(['staff']));
    }


    public function createNotification(Request $request)
    {

        $message = new \App\Notification([
            "title" => $request->title,
            "message" => $request->message,
            "type" => $request->type,
            "staff_id" => $request->staff_id,
            "senderName" => Auth::user()->firstname . " " . Auth::user()->lastname,
            "senderEmail" => Auth::user()->email,
            "senderId" => Auth::user()->id,
        ]);
        if ($message->save()) {
            $staff = \App\User::all();
            alert()->success('Message Sent Successfully', '');
            return view("admin.notification.createNotification", compact(['staff']))->with('status', 'message Sent Successfully');
        } else {
            alert()->error('Could not Send Mail', 'Error');
            return view("admin.notification.createNotification", compact(['staff']))->with('status', 'message Could not be sent');
        }

        $customers = \App\Customer::all();

        $branch_id = Auth::user()->branchId;
        $banks = \App\Bank_Account::all();
        $pos = \App\Pos::all();
    }

    public function readNotif(Request $request, $id)
    {

        // $user_id = Auth::id();
        // $count = \App\Notification::where('staff_id', $user_id)->orWhere('staff_id', null)->count('id');
        // $notif = DB::select(DB::raw("select * from notifications where id = '$id' and (staff_id='$user_id' or staff_id is null)"));
        // // select * from notifications where id = 4 and (staff_id=4 or staff_id = null)
        // $total = $count;
        // dd($id);
        $new = Notification::join('notification_lists', 'notifications.id', 'notification_lists.notification_id')
                ->where('notification_lists.status', 0)
                ->where('notifications.recipient_id', Auth::id())
                ->orWhere('notifications.senderId', Auth::id())
                ->orWhere('notification_lists.notifying_userid', Auth::id())
                ->select('notifications.*', 'notification_lists.notifying_userid');
            $notif = $new->get();
            $total = $new->count('notifications.id');

        return view('admin.notification.readmail', compact(['notif', 'total']));
    }


    public function inbox(Request $request)
    {

        $notif = Notification::join('notification_lists', 'notifications.id', 'notification_lists.notification_id')
        ->where('notification_lists.status', 0)
        ->where('notifications.recipient_id', Auth::id())
        ->orWhere('notifications.senderId', Auth::id())
        ->orWhere('notification_lists.notifying_userid', Auth::id())
        ->select('notifications.*', 'notification_lists.notifying_userid');
        $notif = $notif->get();
        $total = $notif->count('notifications.id');
        return view('admin.notification.inbox', compact(['notif', 'total']));
    }
    
    

    public function newNotification(Request $request)
    {
        # code...
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'message'  => ['required'],
            'user_id'  => ['required'],
            'table_name'  => ['required'],
            'recipient_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'required_fields' => $validator->errors()->all(),
                'message' => 'Missing field(s) | Validation Error',
                'status' => '100'
            ]);
        }
        $issuerId = $request->user_id;
        $notification = new Notification();
        $notification->title = $request->title;
        $notification->message = $request->message;
        $notification->user_id = $issuerId;
        $notification->type = $request->table_name;
        
        //update for other forms of notifications
        if($request->table_name == 'incidenceoprations'){
            $notification->notify_name = 'incidence';
            $notification->type_url_path = '/incident/pending';
        }else{
            $notification->notify_name = $request->table_name;
        }
        
        $notification->recipient_id = $request->recipient_id;
        $saveNotif = $notification->save();

        if ($saveNotif) {
            $user = User::where('id', $issuerId)->first();
            $officeId = $user->office_id;

            $user_office = Office::where('id', $officeId)->first();
            $level = $user_office->level;
            $p1 = $user_office->parentOfficeId;
            $p2 = $user_office->p2;
            $p3 = $user_office->p3;
            $p4 = $user_office->p4;

            // $managerId = $user_office->managerid;

            $thisNotif = Notification::where('senderId', $issuerId)->where('type', $request->table_name)->latest()->first();

            if ($p1 != 0) {
                $office = Office::where('id', $p1)->first();

                $notificationList = new NotificationList();
                $notificationList->notification_id = $thisNotif->id;
                $notificationList->notifying_userid = $office->managerid;
                $notificationList->save();
            }

            if ($p2 != 0) {
                $office = Office::where('id', $p2)->first();

                $notificationList = new NotificationList();
                $notificationList->notification_id = $thisNotif->id;
                $notificationList->notifying_userid = $office->managerid;
                $notificationList->save();
            }

            if ($p3 != 0) {
                $office = Office::where('id', $p3)->first();

                $notificationList = new NotificationList();
                $notificationList->notification_id = $thisNotif->id;
                $notificationList->notifying_userid = $office->managerid;
                $notificationList->save();
            }

            if ($p4 != 0) {
                $office = Office::where('id', $p4)->first();

                $notificationList = new NotificationList();
                $notificationList->notification_id = $thisNotif->id;
                $notificationList->notifying_userid = $office->managerid;
                $notificationList->save();
            }

            $newNotifications = Notification::join('notification_lists', 'notifications.id', 'notification_lists.notification_id')
                ->where('notification_lists.status', 0)
                ->select('notifications.*', 'notification_lists.notifying_userid')
                ->get();
            // return $newNotifications;
            return response()->json([
                "status" => 200,
                "message" => "successful"
            ]);
        }
    }
    
    public function notify(Request $reques)
    {
        # code...
        View::composer('admin.includes.topbar', function($view)
        {
            $new = Notification::join('notification_lists', 'notifications.id', 'notification_lists.notification_id')
                ->where('notification_lists.status', 0)
                ->where('notifications.recipient_id', Auth::id())
                ->orWhere('notifications.senderId', Auth::id())
                ->orWhere('notification_lists.notifying_userid', Auth::id())
                ->select('notifications.*', 'notification_lists.notifying_userid');
            $newNotifications = $new->get();
            $notificationCount = $new->count();
        
            $view->with('notification', $newNotifications)
                ->with('notificationCount', $notificationCount);
        });
    }
    
    public function allNotification()
    {
        # code...
        $notif = \App\Notification::join('notification_lists', 'notifications.id', 'notification_lists.notification_id')
                    ->where('notification_lists.status', 0)
                    ->where('notifications.recipient_id', Auth::id())
                    ->orWhere('notifications.senderId', Auth::id())
                    ->orWhere('notification_lists.notifying_userid', Auth::id())
                    ->select('notifications.*', 'notification_lists.notifying_userid');
                    $notifications = $notif->latest()->get();
            return view('admin.notification.allNotifications', compact(['notifications']));
    }
}
