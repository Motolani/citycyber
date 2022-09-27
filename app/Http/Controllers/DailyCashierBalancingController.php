<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\DailyCashierBalancing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DailyCashierBalancingController extends Controller
{
    //
    public function dailyCashierBalancingIndex()
    {         
        $dailycashier = DB::table('daily_cashier_balancing_cash')
                       // ->join('cashier_fund_requests','cashier_fund_requests.id','daily_cashier_balancing_cash.cashier_fund_request.id')
                        ->join('users','users.id',  'daily_cashier_balancing_cash.user_id')
                        ->join('offices','offices.id', 'daily_cashier_balancing_cash.office_id')
                        ->select('daily_cashier_balancing_cash.*', 'users.firstname as cashier', 'offices.name as office')
                        ->orderBy('id', 'DESC')
                        ->get();
        return view('admin.daily-cashier-balancing.daily-cashier-wallet-balance-index',compact('dailycashier'));
    }
    public function createDailyCashierBalancing()
    {
        $getOffice = \App\Office::find(Auth::user()->id);
        //dd($getOffice);
        $getUser = Auth::user();
        $officename = $getOffice->name;
        $office_id = $getOffice->id;
        return view('admin.daily-cashier-balancing.create-daily-cashier-wallet-balance',compact('getOffice','getUser','officename','office_id'));
    }

    public function storeDailyCashierBalancing(Request $request)
    {
        //create a variable to store todays date
        $todayDate = date('d/m/Y');
        //validate data
        $this->validate($request,[
            'date'=>'date_format:d/m/Y|after_or_equal:'.$todayDate,
            // 'user_id'=>'required',
            // 'office_id'=>'required',
            'one_thousand'=>'required |numeric',
            'five_hundred'=>'required |numeric',
            'two_hundred'=>'required |numeric',
            'one_hundred'=>'required |numeric',
            'fifty_naira'=>'required |numeric',
            'twenty_naira'=>'required |numeric',
            'ten_naira'=>'required |numeric',
            'five_naira'=>'required |numeric',
            'total_cash'=>'required |numeric',
            'total_stake'=>'required |numeric',
            'total_bet_number'=>'required |numeric',
            'total_cash_bet'=>'required |numeric',
            'total_cash_remit'=>'required |numeric',
        ]);
        $getOffice = \App\Office::find(Auth::user()->id);
 
        // collect the data
        $dailycashierbalancing = new DailyCashierBalancing([
            "user_id"=>Auth::user()->id,
            "office_id"=> $getOffice->id,
            "date"=>$request->input('date'),
            "one_thousand"=>$request->input('one_thousand'),
            "five_hundred"=>$request->input('five_hundred'),
            "two_hundred"=>$request->input('two_hundred'),
            "one_hundred"=>$request->input('one_hundred'),
            "fifty_naira"=>$request->input('fifty_naira'),
            "twenty_naira"=>$request->input('twenty_naira'),
            "ten_naira"=>$request->input('ten_naira'),
            "five_naira"=>$request->input('five_naira'),
            "total_cash"=>$request->input('total_cash'),
            "total_stake"=>$request->input('total_stake'),
            "total_bet_number"=>$request->input('total_bet_number'),
            "total_cash_bet"=>$request->input('total_bet_number'),
            "total_cash_remit"=>$request->input('total_cash_remit'),
        ]);
        //save the data to that database
        $dailycashierbalancing->save();
         //redirect to index page
         return redirect('daily-cashier-wallet-balance-index')->with('status','daily cash remit  succesfully inserted');

    }
    public function showDailyCashierBalancing($id)
    {

        //get the office authenticated user
        $getOffice = \App\Office::find(Auth::user()->id);
      
        $cashier_fund_request =\App\CashierFundRequest::where('status','APPROVED')->get();
       
       
        // $single_cashier_fund_request = $cashier_fund_request->amount;
        
        $getUser = Auth::user();
        $officename = $getOffice->name;
        $office_id = $getOffice->id;

         // get the daily cash balancing
          $dailycashierbalancing = DailyCashierBalancing::find($id);
          //dd($dailycashierbalancing);

              // show the view and pass the  $dailycashierbalancing to it
        return view('admin.daily-cashier-balancing.view-daily-cashier-wallet-balance',compact('getOffice','getUser','officename','office_id','dailycashierbalancing', 'cashier_fund_request'));
    }
    public function deleteDailyCashierBalancing($id)
    {
        $dailycashierbalancing = DailyCashierBalancing::find($id);
        $dailycashierbalancing ->delete();
       //redirect to index page
       return redirect('daily-cashier-wallet-balance-index')->with('status','daily cash remit  succesfully deleted');
    }

}
