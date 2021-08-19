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

class BankController extends BaseController
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
    public function createBankAccountForm()
    {
        

        $banks = \App\Bank::all();


        $customers = \App\Customer::all();
        return view("admin.bank_account.createBankAccount", compact(['customers','banks']));

    }

    
    public function createBankAccountFormData(Request $request)
    {
        $id = Auth::user()->id;

        $exp = explode("|",$request->bank_id);
       
        $bank_accounts = new \App\Bank_Account([
            "bank_id"=>$exp[0],
            "bank_name" =>$exp[1],
            "account_number"=>$request->account_number,
            "account_holder_name"=>$request->account_name,
            "created_by"=>$id
        ]);
        
        $bank_accounts->save();

        $banks = \App\Bank::all();


        $customers = \App\Customer::all();
        return view("admin.bank_account.createBankAccount", compact(['customers','banks']))->with('message','Data Created Successfully');
    }

    


    public function viewBankAccount(Request $request){
        
        $bank_accounts = \App\Bank_Account::join('banks','banks.id','bank_accounts.bank_id')
            ->select("bank_accounts.*", "banks.bank_name as bankname", "banks.id as bank_id")->get();
            $banks = \App\Bank::all();
        return view('admin.bank_account.viewBankAccount',compact(['bank_accounts','banks']));
    }


    
    public function updateAndDeleteBankAccount(Request $request)
    {
        $id = Auth::user()->id;
        //  dd($request);
        if(isset($request->submit) && $request->submit == "delete"){
            $delete = \App\Bank_Account::where('id',$request->id)->delete();
            return redirect()->back()->with("message","Successfully Deleted");

        }elseif(isset($request->submit) && $request->submit == "update"){

            $exp = explode("|",$request->bank_id);



            $update = \App\Bank_Account::where('id',$request->id)
            ->update([
            "bank_id"=>$exp[0],
            "bank_name" =>$exp[1],
            "account_number"=>$request->account_number,
            "account_holder_name"=>$request->account_name,
            "created_by"=>$id
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

