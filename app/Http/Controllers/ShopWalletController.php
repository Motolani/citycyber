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
use App\Slip;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        try {
            $shop_wallet->save();
        }
        catch (QueryException $e){
            $error_code = $e->errorInfo[1];

            if($error_code == 1062){
                alert()->error('The Wallet Code already exist', 'Invalid Wallet Code');
                return redirect()->back();
            }
        }

        alert()->success('Office has been successfully Created.', 'Created');
        return redirect()->back();
    }

    public function fundWallet(Request $request, $shopID)
    {
//        $officeID = Auth::user()->office->id;
        $amount = $request->amount;

        //Update the Shop balance
        ShopWallet::where('id', $shopID)->first()
        ->update(['balance' => DB::raw("balance + $amount")]);

        alert()->success("Shop has been successfully Funded.", 'Funded');
        return redirect()->back();
    }

    public function viewFund(Request $request, $shopid)
    {
        $shop = ShopWallet::where('id', $shopid)->first();
        $history = ShopWalletHistory::where("shop_wallet_id", $shopid)
            ->latest()
            ->get();

        return view('admin.shop-wallet.fund', compact('shop', 'history'));
    }

    public function viewAll(Request $request)
    {
        $shopWallets = Auth::user()->offices;
//        dd($shopWallets[0]->shopWallet);
        return view('admin.shop-wallet.shop-list', compact('shopWallets'));
    }

    public function viewAllCashReserves(Request $request)
    {
        $cashReserves = CashReserveWallet::where('am_id', Auth::user()->id)->get();
        return view('admin.shop-wallet.cash-reserve-list', compact('cashReserves'));
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
            $cashReserve = CashReserveWallet::where("office_id", Auth::user()->office->id)->first();

            //Create the Request
            $fundRequest = new CashReserveFundRequest();
            $fundRequest->staff_office_id = Auth::user()->office->id;
            $fundRequest->manager_id = $cashReserve->manager->id;
            $fundRequest->am_id = Auth::user()->id;
            $fundRequest->amount = $amount;
            $fundRequest->description = "";
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
            $fundRequest->description = "FIRST FUNDING";
            $fundRequest->status = "APPROVED";
            $fundRequest->type = "CREDIT";
            $fundRequest->send_type = "CREATED";
            $fundRequest->save();
        }

        alert()->success('Request has been sent successfully.', 'Request Sent');
        return redirect()->back();
    }

    public function viewCreateWallet(Request $request)
    {
        $id = $request->id;
        $office = Office::where('id',$id)->first();
        if(isset($office))
            return view('admin.shop-wallet.create', compact('office'));

        else {
            return redirect()->back();
        }
    }

    public function viewCashiers(Request $request)
    {
        //*TODO: Modify Query to Select all Shop Wallets This AM controls and get the Cashiers from each
        $cashiers = CashierWallet::where('office_id', Auth::user()->office->id)->get();
        return view('admin.shop-wallet.cashiers-list', compact('cashiers'));
    }

    public function index()
    {
        return view('admin.home');
    }

    public function dashboard(Request $request, $id)
    {
        //$officeID = Auth::user()->office->id;
        $shop = ShopWallet::where('office_id', $id)->first();

        $cashiers = CashierWallet::where("office_id", $id)->get();
        $history = ShopWalletHistory::where("shop_wallet_id", $id)
            ->latest()
            ->take(40)
            ->get();

        $cashier_count = CashierWallet::where("office_id", $id)->count();
        return view('admin.shop-wallet.dashboard', compact('shop','history', 'cashiers', 'cashier_count'));
    }

    public function viewFundRequests(Request $request)
    {
        $fundRequests = CashierFundRequest::where('am_id', Auth::user()->id)
            ->latest()
            ->get();
        return view('admin.shop-wallet.fund-requests-list', compact('fundRequests'));
    }


    public function viewSlipRequests(Request $request)
    {
        $slipRequests = Slip::where('manager_id', Auth::user()->id)
            ->latest()
            ->get();
        return view('admin.shop-wallet.slip-requests-list', compact('slipRequests'));
    }


    public function approveCashierFundRequest(Request $request, $requestID)
    {
        $cashier_id = $request->cashier_id;

        //Get the Cashier Wallet
        $cashierWallet = CashierWallet::where('id', Auth::user()->id)->first();

        //Get the Shop Wallet the Cashier Belongs to
        $shopWallet = $cashierWallet->office->shopWallet;

        //Get the Fund Request Row
        $fundRequest = CashierFundRequest::where('id', $requestID)->first();
        $amount = $fundRequest->amount;

        //Check for insufficient funds
        if($amount > $shopWallet->balance) {
            alert()->error('You do not have sufficient funds for this transaction.', 'Insufficient Funds');
            return redirect()->back();
        }

        //Debit Shop Wallet
        $shopWallet->update(['balance' => DB::raw("balance - $amount")]);

        //Credit Cashier
        $cashierWallet->update(['balance' => DB::raw("balance + $amount")]);

        //Change request to Approved
        $fundRequest->status = "APPROVED";
        $fundRequest->save();

        alert()->success('You have successfully approved the Request.', 'Successful');
        return redirect()->back();
    }


    public function approveSlipRequest(Request $request, $requestID)
    {
        //Get the Fund Request Row
        $slipRequest = Slip::where('id', $requestID)->first();
        $amount = $slipRequest->amount;

        //Shop Wallet
        $shopWallet = $slipRequest->office->shopWallet;

        //Cash Reserve
        $cashReserve = CashReserveWallet::where('staff_id', $slipRequest->cashier_id)->first();

        //Debit Shop Wallet
        $shopWallet->update(['balance' => DB::raw("balance - $amount")]);

        //Credit Cash Reserve
        $cashReserve->update(['balance' => DB::raw("balance + $amount")]);

        //Change request to Rejected
        $slipRequest->status = "APPROVED";
        $slipRequest->save();

        alert()->success('You have successfully Approved the Request.', 'Successful');
        return redirect()->back();
    }

    public function disapproveSlipRequest(Request $request, $requestID)
    {
        $request->validate([
            'reason'=> 'required'
        ]);

        $reason = $request->reason;
        //Get the Fund Request Row
        $slipRequest = Slip::where('id', $requestID)->first();

        //Change request to Rejected
        $slipRequest->reason = $reason;
        $slipRequest->status = "DISAPPROVED";
        $slipRequest->save();

        alert()->success('You have successfully Disapproved the Request.', 'Disapproved');
        return redirect()->back();
    }


    public function disapproveCashierFundRequest(Request $request, $requestID)
    {
        //TODO:  Amount must be a positive value
        $request->validate([
            'reason'=> 'required'
        ]);

        $reason = $request->reason;

        //Get the Fund Request Row
        $fundRequest = CashierFundRequest::where('id', $requestID)->first();

        //Change request to Rejected
        $fundRequest->status = "DISAPPROVED";
        $fundRequest->comment = $reason;
        $fundRequest->save();

        alert()->success('You have successfully rejected the Request.', 'Successful');
        return redirect()->back();
    }

}
