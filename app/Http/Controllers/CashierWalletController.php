<?php

namespace App\Http\Controllers;

use App\CashierWallet;
use App\IncidenceOpration;
use App\Office;
use App\OfficeLevel;
use App\ShopWallet;
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
        $office_id = Auth::user()->office->id;
        $office = Office::where('id',$office_id)->first();
        return view('admin.cashier-wallet.create', compact("office"));
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
