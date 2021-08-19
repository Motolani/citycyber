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

class GameController extends BaseController
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
    public function createGameForm()
    {
        
        $offices = \App\Office::all();

        $banks = \App\Bank::all();

        $pos = \App\Pos::all();


        $customers = \App\Customer::all();
        return view("admin.game.createGame", compact(['customers','banks','offices','pos']));

    }

    
    public function createGameFormData(Request $request)
    {


        $check = \App\Game::where('ticket_id',$request->ticket_id)->exists();

        if($check){
            return redirect()->back()->with("message","Ticket Id already Submitted");
        }
        // dd($request);
        $id = Auth::user()->id;
        $charge = 2;
        $amount = $charge + $request->amount;
        $game = new \App\Game([
            "office_id"=>Auth::user()->branchId,
            "ticket_id" =>$request->ticket_id,
            "customer_id"=>$request->customer_id,
            "cashier_id"=>$id,
            "amount"=>$request->amount,
            "type"=>$request->type,
            "payment"=>$request->payment_type,
            "pos_id"=>$request->pos_id,
            "bank_id"=>$request->bank_id,
            "status"=>$request->status,
        ]);
        
        $game->save();

        $offices = \App\Office::all();

        $banks = \App\Bank::all();

        $pos = \App\Pos::all();

        $customers = \App\Customer::all();

        return view("admin.game.createGame", compact(['customers','banks','offices','pos']))->with('message','Data Created Successfully');
    }

    


    public function viewGame(Request $request){
        
        $games = \App\Game::join('offices','offices.id','games.office_id')
                            ->join('banks','banks.id','games.bank_id')
                            ->join('users','users.id','games.cashier_id')
                            ->join('customers','customers.id','games.customer_id')
                            ->join('pos','pos.id','games.pos_id')
                            ->select("banks.bank_name","banks.id as bank_id","customers.name as customer_name", "customers.id as customer_id", "games.amount", "games.id as game_id","games.type as game_type","games.id", "games.ticket_id", "customers.name as customer_name","customers.gender","customers.type as customer_type","games.id as id","games.payment as payment_type","pos.terminal_id","pos.id as pos_id")->get();
        $pos = \App\Pos::all();
        $customers = \App\Customer::all();
        $banks = \App\Bank::all();
        $offices = \App\Office::all();
        return view('admin.game.viewGame',compact(['games','pos','banks','customers']));
    }


    
    public function updateAndDeleteGame(Request $request)
    {
        // dd($request);
        if(isset($request->submit) && $request->submit == "delete"){
            $delete = \App\Game::where('id',$request->id)->delete();
            return redirect()->back()->with("message","Successfully Deleted");

        }elseif(isset($request->submit) && $request->submit == "update"){

            $update = \App\Game::where('id',$request->id)
            ->update([
            "office_id"=>$request->office_id,
            "ticket_id" =>$request->ticket_id,
            "customer_id"=>$request->customer_id,
            "cashier_id"=>$id,
            "amount"=>$request->amount,
            "type"=>$request->game_type,
            "payment"=>$request->payment_type,
            "pos_id"=>$request->pos_id,
            "bank_id"=>$request->bank_id,
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

