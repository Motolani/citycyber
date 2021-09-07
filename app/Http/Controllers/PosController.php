<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus;
use App\BonusOpration;
use App\Level;
use App\Pos;
use Illuminate\Support\Facades\DB;
use SweetAlert;

class PosController extends BaseController
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
    public function createPosForm()
    {
	    $banks = \App\Bank_Account::all();
        return view("admin.pos.createPos", compact('banks'));
    }

    
    public function createPosFormData(Request $request)
    {
        
        $exp = explode("|",$request->bank_id);
        
        $pos = new Pos([
            "terminal_id"=>$request->terminal_id,
            "bank_id" =>$exp[0],//$request->bank_id,
            "bank_name"=>$exp[1],
        ]);

        $pos->save();

        $banks = \App\Bank_Account::all();
            // dd($banks);
            alert()->success('Record Created Successfully', '');
        return view("admin.pos.createPos", compact('banks'))->with('message','Pos Created Successfully');
    }

    


    public function viewPos(Request $request){
        
        $pos = \App\Pos::join('bank_accounts','bank_accounts.id','pos.bank_id')->select("bank_accounts.*", "pos.terminal_id","pos.id as pos_id")->get();
        $banks = \App\Bank_Account::all();
        return view('admin.pos.viewPos',compact(['pos','banks']));

   }


    
    public function updateAndDeletePos(Request $request, $id)
    { 
        if(isset($request->submit) && $request->submit == "delete"){
            $delete = \App\Pos::where('id',$request->id)->delete();
            return redirect()->back()->with("message","Successfully Deleted");

        }elseif(isset($request->submit) && $request->submit == "update"){
            $update = \App\Pos::where('id',$request->id)->update(['bank_id'=>$request->bank_id,'terminal_id'=>$request->terminal_id]);
            if($update){
            return redirect()->back()->with("message","Updated Successfully");
            }else{
                SweetAlert::message('Robots are working!');
                return redirect()->back()->with("message","could not be Updated Successfully"); 
            }
        }
    }


    
}

