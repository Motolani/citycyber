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
        $staffPresent = Attendance::whereDay('created_at', now()->day)->get();
        $birthdaysToday = User::whereMonth('DOB', now()->month)->take(10)->get();
        $shopWalletTransactions = ShopWalletHistory::whereDay('created_at', now()->day)->count();
        $cashierWalletTransactions = CashierWalletHistory::whereDay('created_at', now()->day)->count();
        $cashReserveWalletTransactions = CashReserveHistory::whereDay('created_at', now()->day)->count();
        $totalTransactions = $shopWalletTransactions + $cashierWalletTransactions + $cashReserveWalletTransactions;

        return view('admin.home', compact('birthdaysToday', 'totalOffice', 'totalStaff', 'staffPresent', 'totalTransactions', 'bankAccountsCount'));
    }

}
