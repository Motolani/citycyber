<?php

namespace App\Http\Controllers;

use App\Office;
use App\GameName;
use App\GameCommission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GameCommissionController extends Controller
{
    //
    public function gameCommissionIndex()
    {
        // $gameComm = DB::table('game_commission')
        //                 ->join('game_name','game_name.id',  'game_commission.game_name_id')
        //                 ->select('game_commission.*', 'game_name.name as name ')
        //                 ->orderBy('id', 'DESC')
        //                 ->get();
         //$gameComm =DB::table('commission')
        $gameComm = GameCommission::orderBy('id', 'desc')->get();
         return view('admin.game-commission.game-commission-index',compact('gameComm'));
    }

    public function createGameCommission()
    {
        $getOffice = \App\Office::find(Auth::user()->id);
         
        $gameName =\App\GameName::all();
	      // dd($gameName);
       return view('admin.game-commission.create-game-commission',compact('gameName','getOffice'));
    }
    public function storeGameCommission(Request $request)
    {
         //validate data
         $this->validate($request,[
            'game_name'=>'required',
            'amount'=>'required  |numeric',
            'date_range_from'=>'required',
            'date_range_to'=>'required', 
         ]);
      
         // collect data
         $gameComm  = new GameCommission([
         
            "game_name" => $request->input('game_name'),
            "amount" =>$request->input('amount'),
            "date_range_from" =>$request->input('date_range_from'),
            "date_range_to" =>$request->input('date_range_to'),
         ]);
   
         //store data
    
         $gameComm->save();
       
          //redirect to index page
        return redirect('game-commission-index')->with('status','game commission  data  succesfully inserted');
    }

    public function viewGameCommission($id)
    {

         // get the daily cash balancing
         $gameComm = GameCommission::find($id);
          //dd($dailycashierbalancing);

              // show the view and pass the  $dailycashierbalancing to it
        return view('admin.game-commission.view-game-commission',compact('getOffice','gameComm','gameName'));
    }

    public function editGameCommission($id)
    {
        $gameName = \App\GameName::all();
       
       //get the office authenticated user
       $getOffice = \App\Office::find(Auth::user()->id);
           
       $gameComm = GameCommission::find($id);
        return view('admin.game-commission.edit-game-commission',compact('gameComm','getOffice','gameName'));
    }

    public function updateGameCommission(Request $request,$id)
    {     
          
         // find the object by  the id
         $gameComm = GameCommission::find($id);
           // collect data
         $gameComm->game_name = $request->input('game_name');
         $gameComm ->amount =$request->input('amount');
         $gameComm->date_range_from =$request->input('date_range_from');
         $gameComm->date_range_to=$request->input('date_range_to');
         
         //store data
    
         $gameComm->update();
       
          //redirect to index page
        return redirect('/game-commission-index')->with('status','game commission data updated  succesfully ');
    }

   //delete function
   public function deleteGameCommission($id)
   {
    $gameComm = GameCommission::find($id);
    $gameComm->delete();
      //redirect to index page
      return redirect('/game-commission-index')->with('status','game commission  data succesfully deleted');
   }
}


