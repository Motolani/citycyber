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

class PaymentController extends BaseController
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
    public function createPaymentForm()
    {
        
        $customers = \App\Customer::all();

        // $banks = \App\Bank::all();

        $branch_id = Auth::user()->branchId;
        $banks = \App\Bank_Account::all();

        $pos = \App\Pos::all();

        return view("admin.payment.createPayment", compact(['customers','banks','pos']));

    }

    
    public function createPaymentFormData(Request $request)
    {


        $customers = \App\Customer::all();

        $branch_id = Auth::user()->branchId;
        $banks = \App\Bank_Account::all();
        $pos = \App\Pos::all();
        
        if( $request->trantype == "pos"){
            
            if(!isset($request->reference)){

                alert()->error('Error Message', 'Reference Not Found');
                // return redirect()->back()->with("message","Please enetr a reference");
            }else{
                $reference = $request->reference;
            }
        }elseif($request->trantype == "transfer"){
            if(!isset($request->reference)){
                // return redirect()->back()->with("message","Please enetr a reference");

                alert()->success('Please enter a reference', '');
                return view("admin.payment.createPayment", compact(['customers','banks','pos']));
            }else{
            $reference = $request->reference;
            }
        }
        elseif($request->trantype=="cash"){
            $reference = time().rand(1000,9999);
        }


        $check = \App\Payment::where('reference',$reference)->exists();

        if($check){
            alert()->error('Error Message', 'Reference already Profiled');
            return view("admin.payment.createPayment", compact(['customers','banks','pos']));
            // return redirect()->back()->with("message","Reference already Profiled");
        }

        $id = Auth::user()->id;
        $charge = 2;
        $amount = $charge + $request->amount;
        $payment = new \App\Payment([
            "customer_id"=>$request->customer_id,
            "bank_id" =>$request->bank_id,
            "amount"=>$amount,
            "charge"=>2,
            "actual_amount"=>$request->amount,
            "type"=>$request->trantype,
            "pos_id"=>$request->pos_id,
            "reference"=>$reference,
            // "status"=>$request->status,
        ]);
        
        $payment->save();

        // $customers = \App\Customer::all();

        // $banks = \App\Bank::all();
        alert()->success('Payment Created Successfully', '');
        return view("admin.payment.createPayment", compact(['customers','banks','pos']))->with('message','Data Created Successfully');
    }

    


    public function viewPayment(Request $request){
        
        $payments = \App\Payment::join('customers','customers.id','payments.customer_id')
                ->join('banks','banks.id','payments.bank_id')
                ->select("banks.bank_name","customers.name", "payments.amount","payments.actual_amount", "customers.name as customer_name","customers.gender","customers.type as customer_type","payments.id as id")->orderBy("id","desc")->get();
        
        $customers = \App\Customer::all();
        $banks = \App\Bank::all();
        return view('admin.payment.viewPayment',compact(['payments','banks','customers']));
    }


    
    public function updateAndDeletePayment(Request $request)
    { 
        // dd($request);
        if(isset($request->submit) && $request->submit == "delete"){
            $delete = \App\Payment::where('id',$request->id)->delete();
            return redirect()->back()->with("message","Successfully Deleted");

        }elseif(isset($request->submit) && $request->submit == "update"){

            $update = \App\Payment::where('id',$request->id)
            ->update([
                "customer_id"=>$request->customer_id,
                "bank_id" =>$request->bank_id,
                "amount"=>$amount,
                "charge"=>1,
                "actual_amount"=>$request->amount,
                "type"=>$request->payment_type,
            ]);


                
            if($update){
            return redirect()->back()->with("message","Updated Successfully");
            }else{
                SweetAlert::message('Robots are working!');
                return redirect()->back()->with("message","could not be Updated Successfully"); 
            }
        }
    }
    
}

