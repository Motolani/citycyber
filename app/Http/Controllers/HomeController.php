<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Bank_Account;
use App\CashierWalletHistory;
use App\CashReserveHistory;
use App\Office;
use App\ShopWalletHistory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalStaff = User::where('id', '>', 0)->count();
        $totalOffice = Office::where('id', '>', 0)->count();
        $bankAccountsCount = Bank_Account::where('id', '>', 0)->count();
        $staffPresent = Attendance::whereDay('created_at', now()->day)->pluck('id');
        $staffAbsent = User::whereNotIn('id', $staffPresent)->join("offices","offices.id","users.office_id")
                        ->select("users.*", "offices.name as officename")->get();
        $birthdaysToday = User::whereMonth('DOB', now()->month)->take(10)->get();
        $shopWalletTransactions = ShopWalletHistory::whereDay('created_at', now()->day)->count();
        $cashierWalletTransactions = CashierWalletHistory::whereDay('created_at', now()->day)->count();
        $cashReserveWalletTransactions = CashReserveHistory::whereDay('created_at', now()->day)->count();
        $totalTransactions = $shopWalletTransactions + $cashierWalletTransactions + $cashReserveWalletTransactions;
        
                    // $notify = \App\Notification::join('notification_lists', 'notifications.id', 'notification_lists.notification_id')
                    // ->where('notification_lists.status', 0)
                    // ->where('notifications.recipient_id', Auth::id())
                    // ->orWhere('notifications.senderId', Auth::id())
                    // ->orWhere('notification_lists.notifying_userid', Auth::id())
                    // ->select('notifications.type_url_path', 'notifications.notify_name', DB::raw('count(*) as total'))->groupBy("notifications.notify_name", "notifications.type_url_path");
                    
                    
                    // $notify = $notify->get();
                    // dd($notify);
                    
        return view('admin.home', compact('birthdaysToday', 'totalOffice', 'totalStaff', 'staffAbsent', 'totalTransactions', 'bankAccountsCount'));
    }

}
