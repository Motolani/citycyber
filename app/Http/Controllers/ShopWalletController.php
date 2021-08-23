<?php

namespace App\Http\Controllers;

use App\CashierFundRequest;
use App\CashierWallet;
use App\CashReserveFundRequest;
use App\CashReserveWallet;
use App\IncidenceOpration;
use App\Office;
use App\OfficeLevel;
use App\ShopWallet;
use App\ShopWalletHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Auth;

class ShopWalletController extends BaseController
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
        $officeID = $request->id;
        $request->validate([
            'wallet_code' => 'required|max:20',
        ]);

        //Check if Office Level is Valid
        $office = Office::where("id", $officeID)->where("level", ">", 3)->first();
        if(isset($office)){
            alert()->error('This Office cannot have a Wallet', 'Error');
            return redirect()->back();
        }


        //Check if this Office already has a Wallet
        $shopWallets = ShopWallet::where("office_id", $officeID)->first();
        if(isset($shopWallets)){
            alert()->error('This Office already has a Wallet', 'Error');
            return redirect()->back();
        }

        //Create the Shop Wallet
        $shop_wallet = new ShopWallet();
        $shop_wallet->office_id = $officeID;
        $shop_wallet->wallet_code = $request->wallet_code;
        $shop_wallet->save();
        alert()->success('Office has been successfully Created.', 'Created');
        return redirect()->back();
    }



    public function fundWallet(Request $request)
    {
        $request->validate([
            'amount' => 'required|max:20',
        ]);

        $officeID = Auth::user()->office->id;
        $amount = $request->amount;


        //Get the Shop and add to the balance
        $shop = ShopWallet::where('id', $officeID)->first();
        $shop->balance += $amount;
        $shop->save();


        //Log in Wallet History
        $history = new ShopWalletHistory();
        $history->shop_wallet_id = $officeID;
        $history->staff_id = Auth::user()->id;
        $history->amount = $amount;
        $history->balance_after = $shop->balance;
        $history->save();
        alert()->success('Shop has been successfully Funded.', 'Funded');
        return redirect()->back();
    }



    public function viewFund(Request $request)
    {
        return view('admin.shop-wallet.fund');
    }


    public function showRequestFunds(Request $request)
    {
        $cashiers = CashierWallet::where("office_id", Auth::user()->office->id)->get();
        return view('admin.shop-wallet.request-funds', compact('cashiers'));
    }

    public function requestFunds(Request $request)
    {
        //TODO:  Amount must be a positive value
        $request->validate([
            'amount' => 'required|max:20',
        ]);
        $amount = $request->amount;
        $destination = $request->destination;

        //Check if the Request should go to Cash Reserve
        if($destination == "cash-reserve"){
            $cashReserve = CashReserveWallet::where("office_id", Auth::user()->office->id);

            //Create the Request
            $fundRequest = new CashReserveFundRequest();
            $fundRequest->staff_office_id = Auth::user()->office->id;
            $fundRequest->manager_id = $cashReserve->manager_id;
            $fundRequest->am_id = Auth::user()->id;
            $fundRequest->amount = $amount;
            $fundRequest->description = "FORCED FUNDING";
            $fundRequest->status = "PENDING";
            $fundRequest->type = "CREDIT";
            $fundRequest->send_type = "RAISED";
            $fundRequest->save();
        }
        else{
            //Create a Request for Cashier
            $fundRequest = new CashierFundRequest();
            $fundRequest->staff_office_id = Auth::user()->office->id;
            $fundRequest->cashier_id = $destination;
            $fundRequest->am_id = Auth::user()->id;
            $fundRequest->amount = $amount;
            $fundRequest->description = "FORCED FUNDING";
            $fundRequest->status = "APPROVED";
            $fundRequest->type = "CREDIT";
            $fundRequest->send_type = "CREATED";
            $fundRequest->save();
        }

        alert()->success('Request has been sent successfully.', 'Sent');
        return redirect()->back();
    }



    public function viewCreateWallet(Request $request)
    {
        $id = $request->id;
        $office = Office::where('id',$id)->first();
        if(isset($office))
            return view('admin.shop-wallet.create', compact('office'));

        else
            return redirect()->back();
    }

    public function viewCashiers(Request $request)
    {
        $cashiers = Auth::user()->office->cashiers;
        return view('admin.shop-wallet.cashiers-list', compact('cashiers'));
    }

    public function index()
    {
        return view('admin.home');
    }

    public function dashboard(Request $request)
    {
        $officeID = Auth::user()->office->id;
        $shop = ShopWallet::where('office_id', $officeID)->first();
        $cashier_count = CashierWallet::where("office_id", $officeID)->count();
        return view('admin.shop-wallet.dashboard', compact('shop', 'cashier_count'));
    }

}
