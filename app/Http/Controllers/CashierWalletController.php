<?php

namespace App\Http\Controllers;

use App\CashierFundRequest;
use App\CashierWallet;
use App\CashierWalletHistory;
use App\CashReserveFundRequest;
use App\CashReserveWallet;
use App\IncidenceOpration;
use App\Office;
use App\OfficeLevel;
use App\ShopWallet;
use App\Slip;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashierWalletController extends BaseController
{
    /**
     * Create a new controller instance.
     *acceptFunds
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
        //TODO:  Assign a Staff to the Cashier Wallet
        $officeID = Auth::user()->office->id;
        $request->validate([
            'wallet_code' => 'required|max:20',
        ]);

        //Create the Shop Wallet
        $wallet = new CashierWallet();
        $wallet->office_id = $officeID;
        $wallet->wallet_code = $request->wallet_code;
        try {
            $wallet->save();
        }
        catch (QueryException $e){
            $error_code = $e->errorInfo[1];

            if($error_code == 1062){
                alert()->error('The Wallet Code already exist', 'Invalid Wallet Code');
                return redirect()->back();
            }
        }
        alert()->success('Cashier has been successfully Created.', 'Created');
        return redirect()->back();
    }

    public function viewAdd(Request $request)
    {
        $offices = Office::where('level', '>', 3)->get();
        return view('admin.cashier-wallet.create', compact("offices"));
    }

    public function viewRequestFunds(Request $request)
    {
        return view('admin.cashier-wallet.request-funds');
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
        if($destination == "bm"){
            $cashReserve = CashReserveWallet::where("office_id", Auth::user()->office->id)->first();

            //Create the Request in Slips Table
            $fundRequest = new Slip();
            $fundRequest->manager_office_id = Auth::user()->office->id;
            $fundRequest->manager_id = $cashReserve->branchManager->id;
            $fundRequest->cashier_id = Auth::user()->id;
            $fundRequest->amount = $amount;
            $fundRequest->description = "REQUEST EXTRA FUNDS";
            $fundRequest->status = "PENDING";
            $fundRequest->type = "OUTSLIP";
            $fundRequest->save();
        }
        else{
            //Create a Request for Shop Wallet
            $fundRequest = new CashierFundRequest();
            $fundRequest->staff_office_id = Auth::user()->office->id;
            $fundRequest->cashier_id = Auth::user()->id;
            $fundRequest->am_id = Auth::user()->office->manager->id;
            $fundRequest->amount = $amount;
            $fundRequest->description = "";
            $fundRequest->status = "PENDING";
            $fundRequest->type = "CREDIT";
            $fundRequest->send_type = "RAISED";
            $fundRequest->save();
        }

        alert()->success('Request has been sent successfully.', 'Request Sent');
        return redirect()->back();
    }

    public function viewFundCashier(Request $request, $cashierID)
    {
        $cashier = CashierWallet::where('id', $cashierID)->first();
        $history = CashierWalletHistory::where("staff_id", $cashierID)
            ->latest()
            ->take(40)
            ->get();
        return view('admin.cashier-wallet.fund', compact("cashier", "history"));
    }

    public function fundCashier(Request $request)
    {
        //TODO:  Amount must be a positive value
        $request->validate([
            'amount' => 'required|max:20',
        ]);
        $amount = $request->amount;
        $cashier_id = $request->cashier_id;

        //Get the ShopWallet and Check if it has sufficient funds
        $shop = Auth::user()->office->shopWallet;

        if($shop->balance < $amount) {
            alert()->error('You do not have sufficient Funds.', 'Insufficient Funds');
            return redirect()->back();
        }

        //Create a Request and Mark it as Approved
        $fundRequest = new CashierFundRequest();
        $fundRequest->staff_office_id = Auth::user()->office->id;
        $fundRequest->cashier_id = $cashier_id;
        $fundRequest->am_id = Auth::user()->id;
        $fundRequest->amount = $amount;
        $fundRequest->description = "FIRST FUNDING";
        $fundRequest->status = "APPROVED";
        $fundRequest->type = "CREDIT";
        $fundRequest->send_type = "CREATED";
        $fundRequest->save();

        //Debit the ShopWalet
        $shop->update(['balance' => DB::raw("balance - $amount")]);

        //Get the Cashier and credit their balance
        $cashier = CashierWallet::where('id', $cashier_id)->first();
        $cashier->update(['balance' => DB::raw("balance + $amount")]);

        alert()->success('Cashier has been successfully Funded.', 'Funded');
        return redirect()->back();
    }

    public function rejectFunds(Request $request, $requestID)
    {
        //TODO:  Amount must be a positive value
        $request->validate([
            'reason'=> 'required'
        ]);

        $reason = $request->reason;
        $cashier_id = $request->cashier_id;

        //Get the Cashier Wallet
        $cashierWallet = CashierWallet::where('id', Auth::user()->id)->first();

        //Get the Fund Request Row
        $fundRequest = CashierFundRequest::where('id', $requestID)->first();

        //Get the Shop Wallet
        $shopWalletQuery = ShopWallet::where('office_id', $fundRequest->staff_office_id)->first();

        //Get amount to refund
        $amountToRefund = $fundRequest->amount;

        /*
         * Check if the Cashier Balance is enough for the refund
         * Smart Asses might Spend the money and refund
         * */
        if($cashierWallet->balance < $amountToRefund) {
            alert()->error('You do not have sufficient Funds for this refund.', 'Insufficient Funds');
            return redirect()->back();
        }

        //Debit the Cashier Wallet
        $cashierWallet->update(['balance' => DB::raw("balance - $amountToRefund")]);

        //Credit the AM Shop Wallet balance
        $shopWalletQuery->update(['balance' => DB::raw("balance + $amountToRefund")]);

        //Change request to Rejected
        $fundRequest->status = "REJECTED";
        $fundRequest->comment = $reason;
        $fundRequest->save();

        alert()->success('You have successfully rejected the Funds.', 'Successful');
        return redirect()->back();
    }

    public function acceptFunds(Request $request, $requestID)
    {
        //Get the Fund Request Row
        $fundRequest = CashierFundRequest::where('id', $requestID)->first();

        //Change request to Rejected
        $fundRequest->status = "ACCEPTED";
        $fundRequest->save();

        alert()->success('You have successfully rejected the Funds.', 'Successful');
        return redirect()->back();
    }

    public function callbackFunds(Request $request, $cashierID)
    {
        //Get the Cashier Wallet
        $cashierWalletQuery = CashierWallet::where('id', $cashierID);
        $cashierWallet = $cashierWalletQuery->first();

        //Get the Shop Wallet
        $shopWalletQuery = ShopWallet::where('office_id', $cashierWallet->office_id);
        $shopWallet = $shopWalletQuery->first();

        //Get amount to refund
        $amountToCallback = $cashierWallet->balance;

        //Debit the Cashier Wallet
        $cashierWalletQuery->update(['balance' => DB::raw("balance - $amountToCallback")]);

        //Credit the AM Shop Wallet balance
        $shopWalletQuery->update(['balance' => DB::raw("balance + $amountToCallback")]);

        //Create Record in request table
        $fundRequest = new CashierFundRequest();
        $fundRequest->staff_office_id = Auth::user()->office->id;
        $fundRequest->cashier_id = $cashierID;
        $fundRequest->am_id = Auth::user()->office->manager->id;
        $fundRequest->amount = $amountToCallback;
        $fundRequest->description = "CALLBACK";
        $fundRequest->status = "CALLBACK";
        $fundRequest->type = "DEBIT";
        $fundRequest->send_type = "RAISED";
        $fundRequest->save();

        alert()->success('Funds have been credited to the Shop Wallet.', 'Successful');
        return redirect()->back();
    }

    public function viewCashiers(Request $request, $officeID)
    {
        $cashiers = CashierWallet::where('office_id', $officeID)
            ->latest()
            ->get();
        return view('admin.shop-wallet.cashiers-list', compact('cashiers'));
    }

    public function showFundRequests(Request $request)
    {
        $fundRequests = CashierFundRequest::where('cashier_id', Auth::user()->id)
            ->with('cashier')
            ->latest()
            ->get();
        return view('admin.cashier-wallet.fund-requests-list', compact('fundRequests'));
    }

    public function showSlipRequests(Request $request)
    {
        $slipRequests = Slip::where('cashier_id', Auth::user()->id)
            ->latest()
            ->get();
        return view('admin.cashier-wallet.slip-requests-list', compact('slipRequests'));
    }

    public function index()
    {
        return view('admin.home');
    }

    public function dashboard(Request $request)
    {
        $cashierWallet = CashierWallet::where('id', Auth::user()->id)->first();
        $history = CashierWalletHistory::where('');
        return view('admin.cashier-wallet.dashboard', compact('cashierWallet'));
    }

    public function acceptSlipRequest(Request $request, $requestID)
    {

        //Get the Fund Request Row
        $slipRequest = Slip::where('id', $requestID)->first();
        $amount = $slipRequest->amount;


        //Get the Cash Reserve
        $cashReserve = CashReserveWallet::where('am_id', $slipRequest->manager_id)->first();

        //Get the Cashier Wallet
        $cashierWallet = $slipRequest->cashier;

        /*
         * Check if the Cash Reserve Balance is enough for the transaction
         * */
        if($cashReserve->balance < $amount) {
            alert()->error('You do not have sufficient Funds.', 'Insufficient Funds');
            return redirect()->back();
        }

        //Credit the Cash Reserve
        $cashReserve->update(['balance' => DB::raw("balance + $amount")]);

        //Debit the Cashier Wallet
        $cashierWallet->update(['balance' => DB::raw("balance - $amount")]);

        //Change request to Rejected
        $slipRequest->status = "APPROVED";
        $slipRequest->save();


        alert()->success('Request has been approved.', 'Approved');
        return redirect()->back();
    }

    public function rejectSlipRequest(Request $request, $requestID)
    {
        //TODO:  Amount must be a positive value
        $request->validate([
            'reason'=> 'required'
        ]);

        $reason = $request->reason;
        $cashier_id = $request->cashier_id;

        //Get the Cashier Wallet
        $cashierWallet = CashierWallet::where('id', Auth::user()->id)->first();

        //Get the Fund Request Row
        $slipRequest = Slip::where('id', $requestID)->first();

        //Get the Cashier Wallet
        $cashierWallet = $slipRequest->cashier;

        //Change request to Rejected
        $slipRequest->status = "DISAPPROVED";
        $slipRequest->save();

        alert()->success('Request has been rejected.', 'Disapproved');
        return redirect()->back();
    }



}
