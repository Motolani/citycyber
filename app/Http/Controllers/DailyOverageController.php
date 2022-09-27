<?php

namespace App\Http\Controllers;

use App\DailyOverage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyOverageController extends Controller
{
    //
    public function dailyVirtualOverageIndex()
    {
        $overage = DailyOverage::orderBy('id', 'desc')->get();
        return view('admin.daily-overage.daily-virtual-overage-index',compact('overage'));
    }

    public function createDailyVirtualOverage()
    {
        $getOffice = \App\Office::find(Auth::user()->id);
         
        $gameName =\App\GameName::all();
        return view('admin.daily-overage.create-daily-virtual-overage',compact('getOffice','gameName')); 
    }

    public function storeDailyVirtualOverage(Request $request)
    {
         //validate data
         $this->validate($request,[
            'game_name'=>'required',
            'amount'=>'required  |numeric',
            'date'=>'required',
         ]);
      
         // collect data
         $overage  = new DailyOverage([
         
            "game_name" => $request->input('game_name'),
            "amount" =>$request->input('amount'),
            "date" =>$request->input('date'),
         ]);
   
         //store data
    
         $overage->save();

           //redirect to index page
        return redirect('daily-virtual-overage-index')->with('status','virtual overage  data  succesfully inserted');
    }

    // public function viewVirtualOverage($id)
    // {

    //      // get the daily cash balancing
    //      $overage =  DailyOverage::find($id);
    //       //dd($dailycashierbalancing);

    //           // show the view and pass the  $dailycashierbalancing to it
    //     return view('admin.game-commission.view-game-commission',compact('getOffice','gameComm','gameName'));
    // }

    public function editDailyVirtualOverage($id)
    {
        $gameName = \App\GameName::all();
       
       //get the office authenticated user
       $getOffice = \App\Office::find(Auth::user()->id);
           
       $overage = DailyOverage::find($id);
        return view('admin.daily-overage.edit-daily-virtual-overage',compact('overage','getOffice','gameName'));
    }

    public function updateDailyVirtualOverage(Request $request,$id)
    {     
          
         // find the object by  the id
         $overage =  DailyOverage::find($id);
           // collect data
           $overage->game_name = $request->input('game_name');
           $overage ->amount =$request->input('amount');
           $overage->date=$request->input('date');
   
         
         //store data
    
         $overage->update();
       
          //redirect to index page
        return redirect('/daily-virtual-overage-index')->with('status','virtual overage data updated  succesfully ');
    }

   //delete function
   public function deleteDailyVirtualOverage($id)
   {
    $overage = DailyOverage::find($id);
    $overage->delete();
      //redirect to index page
      return redirect('/daily-virtual-overage-index')->with('status','virtual overage  data succesfully deleted');
   }
}
