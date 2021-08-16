<?php

namespace App\Http\Controllers;

use App\IncidenceOpration;
use App\Office;
use App\OfficeLevel;
use App\ShopWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;

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


    public function viewCreateWallet(Request $request)
    {
        $id = $request->id;
        $office = Office::where('id',$id)->first();
        if(isset($office))
            return view('admin.wallet.create', compact('office'));

        else
            return redirect()->back();
    }

    public function index()
    {
        return view('admin.home');
    }

    public function dashboard()
    {
        return view('admin.wallet.dashboard');
    }

}
