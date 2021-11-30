<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus;
use App\BonusOpration;
use App\Level;
use App\Pos;
use App\Customer;
use App\Payment;
use Illuminate\Support\Facades\DB;
use SweetAlert;
use Illuminate\Support\Facades\Auth;

class WinController extends BaseController
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
    public function createWinForm()
    {
        
        $offices = \App\Office::all();

        $banks = \App\Bank::all();

        $pos = \App\Pos::all();


        $customers = \App\Customer::all();
        return view("admin.win.createWin", compact(['customers','banks','offices','pos']));

    }

    
    public function createWinFormData(Request $request)
    {

        // dd($request);
        $check = \App\Win::where('ticket_id',$request->ticket_id)->exists();

        // if($check){
        //     alert()->success('Ticket id Alra', '');
        //     return redirect()->back()->with("message","Ticket Id already Submitted");
        // }
        // dd($request);
        $id = Auth::user()->id;
        $charge = 2;
        $amount = $charge + $request->amount;
        $win = new \App\Win([
            "office_id"=>Auth::user()->branchId,
            "ticket_id" =>$request->ticket_id,
            "customer_id"=>$request->customer_id,
            "cashier_id"=>$id,
            "cashier_name"=>Auth::user()->firstname,
            "amount"=>$request->amount,
            "type"=>$request->type,
            // "payment"=>$request->payment_type,
        ]);
        
        $win->save();

        $offices = \App\Office::all();

        $banks = \App\Bank::all();

        $pos = \App\Pos::all();

        $customers = \App\Customer::all();

        alert()->success('Data Created Successfully!!', '');

        return view("admin.win.createWin", compact(['customers','banks','offices','pos']))->with('message','Data Created Successfully');
    }

    


    public function viewWin(Request $request){
        
        $wins = \App\Win::join('offices','offices.id','wins.office_id')
                            ->join('users','users.id','wins.cashier_id')
                            ->join('customers','customers.id','wins.customer_id')
                            ->select("customers.name as customer_name", "customers.id as customer_id", "wins.amount", "wins.id as win_id","wins.type as win_type","wins.id", "wins.ticket_id", "customers.name as customer_name","customers.gender","customers.type as customer_type","wins.id as id")->get();
        $customers = \App\Customer::all();
        return view('admin.win.viewWin',compact(['wins','customers']));
    }


    
    public function updateAndDeleteWin(Request $request)
    {
        $id = Auth::user()->id;
        // dd($request);
        if(isset($request->submit) && $request->submit == "delete"){
            $delete = \App\Win::where('id',$request->id)->delete();
            return redirect()->back()->with("message","Successfully Deleted");

        }elseif(isset($request->submit) && $request->submit == "update"){

            $update = \App\Win::where('id',$request->id)
            ->update([
            "office_id"=>Auth::user()->branchId,
            "ticket_id" =>$request->ticket_id,
            "customer_id"=>$request->customer_id,
            "cashier_id"=>$id,
            "cashier_name"=>Auth::user()->firstname,
            "amount"=>$request->amount,
            "type"=>$request->win_type,
            "status"=>"pending",
            ]);

            
                
            if($update){
            return redirect()->back()->with("message","Updated Successfully");
            }else{
                // SweetAlert::message('Robots are working!');
                return redirect()->back()->with("message","could not be Updated Successfully"); 
            }
        }
    }
    
}

