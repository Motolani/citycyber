<?php

namespace App\Http\Controllers;

use App\CashierFundRequest;
use App\CashierWallet;
use App\CashReserve;
use App\CashReserveFundRequest;
use App\CashReserveWallet;
use App\IncidenceOpration;
use App\Office;
use App\OfficeLevel;
use App\ShopWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Auth;

class CashReserveController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Add this line to call Parent Constructor from BaseController
        parent::__construct();

        $this->middleware('auth');
    }

    public function createWallet(Request $request)
    {
        $officeID = $request->office;
        $request->validate([
            'office' => 'required|max:20',
            'wallet_code'=> 'required|max:20',
        ]);

        //Check if Office exists
        $office = Office::where("id", $officeID)->first();

        if(isset($office)){
            //Create the Cash Reserve Wallet
            $wallet = new CashReserveWallet();
            $wallet->office_id = $officeID;
            $wallet->staff_id = $office->managerid;
            $wallet->wallet_code = $request->wallet_code;
            $wallet->save();
            alert()->success('Cash Reserve has been  Created successfully.', 'Created');
            return redirect()->back();
        }
        else{
            alert()->error('Office does not exist .'.$office->name, 'Error');
            return redirect()->back();
        }

    }


    public function viewAdd(Request $request)
    {
        $office_id = Auth::user()->office->id;
        $office = Office::where('id',$office_id)->first();
        return view('admin.cash-reserve.create', compact("office"));
    }


    public function viewRequestFunds(Request $request)
    {
        return view('admin.cash-reserve.request-funds');
    }


    public function requestFunds(Request $request)
    {
    }


    public function viewFundCashReserve(Request $request, $cashierID)
    {
        $cashier = CashierWallet::where('id', $cashierID);
        return view('admin.cash-reserve.fund', compact("cashier"));
    }


    public function viewCreate(Request $request)
    {
        $offices = Office::where("level", ">", 3)->get();
        return view('admin.cash-reserve.create', compact('offices'));
    }

    public function fundRequests(Request $request)
    {
        $fundRequests = CashReserveFundRequest::where('am_id', Auth::user()->id)->latest()->get();
        return view('admin.cash-reserve.fund-requests-list', compact('fundRequests'));
    }

    public function index()
    {
        return view('admin.home');
    }

    public function dashboard(Request $request)
    {
        $cashReserve = CashReserveWallet::where('id', Auth::user()->id)->first();
        return view('admin.cash-reserve.dashboard', compact('cashReserve'));
    }

}
