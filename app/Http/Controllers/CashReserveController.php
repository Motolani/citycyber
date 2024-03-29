<?php

namespace App\Http\Controllers;

use App\CashierFundRequest;
use App\CashierWallet;
use App\CashReserve;
use App\CashReserveFundRequest;
use App\CashReserveHistory;
use App\CashReserveWallet;
use App\IncidenceOpration;
use App\Office;
use App\OfficeLevel;
use App\ShopWallet;
use App\Slip;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        //TODO: Validate the Wallet code to make sure it has not been used
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
            $wallet->am_id = Auth::user()->id;
            $wallet->office_id = $officeID;
            $wallet->staff_id = $office->managerid;
            $wallet->wallet_code = $request->wallet_code;
            try{
                $wallet->save();
            }
            catch (QueryException $e){
                $error_code = $e->errorInfo[1];

                if($error_code == 1062){
                    alert()->error('The Wallet Code already exist', 'Invalid Wallet Code');
                    return redirect()->back();
                }
            }
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
        //Get Logged in User Office
        $id = Auth::user()->id;
        $staffs = User::find($id);
        $cashiers = Office::where('id', $id)->get();
        //$cashiers = Auth::user()->office->cashiers;
        //dd($staffs);
        return view('admin.cash-reserve.request-funds', compact('cashiers', 'staffs'));
    }


    public function requestFunds(Request $request)
    {
        //TODO:  Amount must be a positive value
        $request->validate([
            'amount' => 'required|max:20',
        ]);
        $amount = $request->amount;
        $cashier = $request->cashier;
	$destination = $request->destination;
	$cashier = Auth::user()->id;

        $cashReserve = CashReserveWallet::where("office_id", Auth::user()->office_id)->first();
	Log:info("new-error" . $cashReserve);

        //Create the Request in Slips Table
        $fundRequest = new Slip();
        $fundRequest->manager_office_id = Auth::user()->office_id;
        $fundRequest->manager_id = $cashReserve->areaManager->id;
        $fundRequest->cashier_id = $cashier;
        $fundRequest->amount = $amount;
        $fundRequest->description = "REQUEST EXTRA FUNDS";
        $fundRequest->status = "PENDING";
        $fundRequest->type = "INSLIP";
        $fundRequest->save();
//        }

        alert()->success('Request has been sent successfully.', 'Request Sent');
        return redirect()->back();
    }



    public function viewFundCashReserve(Request $request, $cashReserveId)
    {
        $cashReserve = CashReserveWallet::where('id', $cashReserveId)->first();
        $history = CashReserveHistory::where('cash_reserve_id', $cashReserveId)->get();
        return view('admin.cash-reserve.fund-cash-reserve', compact("cashReserve", "history"));
    }

    public function fundCashReserve(Request $request)
    {
        //Get the Cash Reserve Wallet
        $cashReserve = CashReserveWallet::where('id', $request->id)->first();

        //Get amount to fund
        $amount = $request->amount;

        //Debit the Cashier Wallet
        $cashReserve->update(['balance' => DB::raw("balance + $amount")]);

        //Create Record in request table
        $fundRequest = new CashReserveFundRequest();
        $fundRequest->bm_id = $cashReserve->office->managerid;
        $fundRequest->am_id = Auth::user()->id;
        $fundRequest->amount = $amount;
        $fundRequest->description = "Funds from Area Manager";
        $fundRequest->status = "APPROVED";
        $fundRequest->type = "CREDIT";
        $fundRequest->save();

        alert()->success('Funds have been credited to the Cash Reserve.', 'Successful');
        return redirect()->back();
    }

    public function viewCreate(Request $request)
    {
        $offices = Office::where("level", ">", 3)
            ->latest()
            ->get();
        return view('admin.cash-reserve.create', compact('offices'));
    }

    public function fundRequests(Request $request)
    {
        $fundRequests = CashReserveFundRequest::where('am_id', Auth::user()->id)
            ->latest()
            ->get();
        return view('admin.cash-reserve.fund-requests-list', compact('fundRequests'));
    }

    public function showSlipRequests(Request $request)
    {
       /* $slips = Slip::where('manager_id', Auth::user()->id)
            ->latest()
	    ->get();*/
	$slips = Slip::join('users', 'user.id', 'slips.cashier_id')->get(['slips.*', 'user.firstname as cashier']);
        return view('admin.cash-reserve.slips-list', compact('slips'));
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

    public function viewAll(Request $request)
    {
        $cashReserve = CashReserveWallet::where('id', Auth::user()->id)->first();
        return view('admin.cash-reserve.dashboard', compact('cashReserve'));
    }

    public function acceptCashierRequest(Request $request, $requestID)
    {
        //Get the Fund Request Row
        $slipRequest = Slip::where('id', $requestID)->first();
        $amount = $slipRequest->amount;


        //Get the Cash Reserve
        $cashReserve = CashReserveWallet::where('staff_id', $slipRequest->manager_id)->first();

        //Get the Cashier Wallet
        $cashierWallet = $slipRequest->cashier;

        /*
         * Check if the Cash Reserve Balance is enough for the refund
         * */
        if($cashReserve->balance < $amount) {
            alert()->error('You do not have sufficient Funds.', 'Insufficient Funds');
            return redirect()->back();
        }

        //Debit the BM Wallet
        $cashReserve->update(['balance' => DB::raw("balance - $amount")]);

        //Credit the Cashier
        $cashierWallet->update(['balance' => DB::raw("balance + $amount")]);

        //Change request to Rejected
        $slipRequest->status = "APPROVED";
        $slipRequest->save();


        alert()->success('Request has been approved.', 'Approved');
        return redirect()->back();    }


    public function rejectCashierRequest(Request $request, $requestID)
    {
        $request->validate([
            'reason'=> 'required'
        ]);

        $reason = $request->reason;

        //Get the Fund Request Row
        $slipRequest = Slip::where('id', $requestID)->first();

        //Change request to Rejected
        $slipRequest->status = "DISAPPROVED";
        $slipRequest->comment = $reason;
        $slipRequest->save();

        alert()->success('You have successfully rejected the request.', 'Successful');
        return redirect()->back();
    }


    public function callbackFunds(Request $request, $id)
    {
        //Get the Cashier Wallet
        $cashierReserve = CashReserveWallet::where('id', $id)->first();

        //Get the Shop Wallet
        $shopWallet = ShopWallet::where('office_id', $cashierReserve->office_id)->first();

        //Get amount to refund
        $amountToCallback = $cashierReserve->balance;

        //Debit the Cashier Wallet
        $cashierReserve->update(['balance' => DB::raw("balance - $amountToCallback")]);

        //Credit the AM Shop Wallet balance
        $shopWallet->update(['balance' => DB::raw("balance + $amountToCallback")]);

        //Create Record in request table
        $fundRequest = new CashReserveFundRequest();
        $fundRequest->bm_id = $shopWallet->office->managerid;
        $fundRequest->am_id = Auth::user()->id;
        $fundRequest->amount = $amountToCallback;
        $fundRequest->description = "CALLBACK";
        $fundRequest->status = "CALLBACK";
        $fundRequest->type = "DEBIT";
        $fundRequest->save();

        alert()->success('Funds have been credited to the Shop Wallet.', 'Successful');
        return redirect()->back();
    }


}
