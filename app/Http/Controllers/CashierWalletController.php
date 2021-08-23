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
use App\Slip;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Auth;

class CashierWalletController extends BaseController
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
        //TODO:  Assign a Staff to the Cashier Wallet
        $officeID = Auth::user()->office->id;
        $request->validate([
            'wallet_code' => 'required|max:20',
        ]);

        //Create the Shop Wallet
        $wallet = new CashierWallet();
        $wallet->office_id = $officeID;
        $wallet->wallet_code = $request->wallet_code;
        $wallet->save();
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
            //Create a Request for AM Shop Wallet
            $fundRequest = new CashierFundRequest();
            $fundRequest->staff_office_id = Auth::user()->office->id;
            $fundRequest->cashier_id = $destination;
            $fundRequest->am_id = Auth::user()->office->manager->id;
            $fundRequest->amount = $amount;
            $fundRequest->description = "FORCED FUNDING";
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
        return view('admin.cashier-wallet.fund', compact("cashier"));
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
        $fundRequest->description = "FORCED FUNDING";
        $fundRequest->status = "APPROVED";
        $fundRequest->type = "CREDIT";
        $fundRequest->send_type = "CREATED";
        $fundRequest->save();

        //Debit the ShopWalet
        $shop->balance -= $amount;
        $shop->save();

        //Get the Cashier and credit their balance
        $cashier = CashierWallet::where('id', $cashier_id)->first();
        $cashier->balance += $amount;
        $cashier->save();

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
        $shopWallet = ShopWallet::where('office_id', $fundRequest->staff_office_id)->first();

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
        $cashierWallet->balance -= $amountToRefund;
        $cashierWallet->save();

        //Credit the AM Shop Wallet balance
        $shopWallet->balance += $amountToRefund;
        $shopWallet->save();

        //Change request to Rejected
        $fundRequest->status = "REJECTED";
        $fundRequest->comment = $reason;
        $fundRequest->save();

        alert()->success('You have successfully rejected the Funds.', 'Successful');
        return redirect()->back();
    }

    public function callbackFunds(Request $request, $cashierID)
    {
        //Get the Cashier Wallet
        $cashierWallet = CashierWallet::where('id', $cashierID)->first();

        //Get the Shop Wallet
        $shopWallet = ShopWallet::where('office_id', $cashierWallet->office_id)->first();

        //Get amount to refund
        $amountToCallback = $cashierWallet->balance;

        //Debit the Cashier Wallet
        $cashierWallet->balance -= $amountToCallback;
        $cashierWallet->save();

        //Credit the AM Shop Wallet balance
        $shopWallet->balance += $amountToCallback;
        $shopWallet->save();

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

    public function viewCashiers(Request $request)
    {
        //*TODO: Modify Query to Select all Shop Wallets This AM controls and get the Cashiers from each
        $cashiers = CashierWallet::where('office_id', Auth::user()->office->id)
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
        return view('admin.cashier-wallet.dashboard', compact('cashierWallet'));
    }

    public function acceptSlipRequest(Request $request, $requestID)
    {
        $amount = $request->amount;

        //Get the Fund Request Row
        $slipRequest = Slip::where('id', $requestID)->first();

        //Get the Cash Reserve
        $cashReserve = CashReserveWallet::where('staff_id', $slipRequest->manager_id)->first();

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
        $cashReserve->balance += $amount;
        $cashReserve->save();

        //Debit the Cashier Wallet
        $cashierWallet->balance -= $amount;
        $cashierWallet->save();

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
