<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus;
use App\BonusOpration;
use App\Level;
use App\Pos;
use App\Customer;
use Illuminate\Support\Facades\DB;
use SweetAlert;
use Illuminate\Support\Facades\Auth;

class CustomerController extends BaseController
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
    public function createCustomerForm()
    {
	    $offices = \App\Office::all();
        return view("admin.customer.createCustomer", compact('offices'));
    }

    
    public function createCustomerFormData(Request $request)
    {
        

        // $check = \App\Customer::where("code")->exists();


        $id = Auth::user()->id;
        $offices = \App\Office::all();
        $customer = new \App\Customer([
            "office_id"=>$request->office_id,
            "cashier_id" =>$id,
            "gender"=>$request->gender,
            "name" =>$request->customer_name,
            "type"=>$request->customer_type,
            "dob"=>$request->dob,
            "customer_code"=>$request->customer_code,
        ]);
        
        if($customer->save()){
            alert()->success('Record Created Successfully', '');
            return view("admin.customer.createCustomer", compact('offices'))->with('message','Customer Created Successfully');
        }
        else{
            alert()->error('Error Message', 'Record Not Created Successfully');
            return view("admin.customer.createCustomer", compact('offices'))->with('message','Customer Created Successfully');
        }
        
               
    }

    


    public function viewCustomer(Request $request){
        
        $customers = \App\Customer::join('offices','offices.id','customers.office_id')
                            ->join('users','users.id','customers.cashier_id')
                            ->select("offices.name as office_name", "offices.id as office_id", "customers.name as customer_name","customers.gender","customers.type","users.firstname","customers.id as id")->get();
        $offices = \App\Office::all();
        return view('admin.customer.viewCustomer',compact(['customers','offices']));

   }


    
    public function updateAndDeleteCustomer(Request $request)
    { 
        if(isset($request->submit) && $request->submit == "delete"){
            $delete = \App\Pos::where('id',$request->id)->delete();
            return redirect()->back()->with("message","Successfully Deleted");

        }elseif(isset($request->submit) && $request->submit == "update"){

            $update = \App\Pos::where('id',$request->id)
            ->update([
                'office_id'=>$request->office_id,
                'cashier_id'=>$request->cashier_id,
                'gender'=>$request->gender,
                'name'=>$request->cusromer_name,
                'type'=>$request->customer_type,
                'dob'=>$request->dob,
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

