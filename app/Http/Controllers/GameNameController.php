<?php

namespace App\Http\Controllers;

use App\GameName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameNameController extends Controller
{
    //
    public function gameNameIndex()
    {

         $gameName = GameName::orderBy('created_at','DESC')->get();
         return view('admin.gamename.game-name-index',compact('gameName'));
    }

    public function createGameName()
    {
      $getOffice = \App\Office::find(Auth::user()->id);
     
      $getUser = Auth::user();
        return view('admin.gamename.create-game-name',compact('getOffice','getUser'));
    }

    public function storeGameName(Request $request)
    {
       
         //validate data
         $this->validate($request,[
            'name'=>'required',
         ]);
	 // collect data

         $gameName = new GameName([
          "name"=> $request->input('name')
   	]);
         //store data
         $gameName->save();
          //redirect to index page
        return redirect('game-name-index')->with('status','game name data  succesfully inserted');
    }

    public function editGameName($id)
    {
        $gameName = GameName::find($id);
       return view('admin.gamename.edit-game-name',compact('gameName'));
    }

    public function updateGameName(Request $request,$id)
    {
      // dd($id);
         // collect data
         $gameName  = GameName::find($id);
        //  dd($gameName);
         $gameName->name = $request->input('name');
           //store data
        $gameName->update();
       
          //redirect to index page
        return redirect('/game-name-index')->with('status','game name data updated  succesfully ');
    }

   //delete function
   public function deleteGameName($id)
   {
    $gameName= GameName::find($id);
    $gameName->delete();
      //redirect to index page
      return redirect('/game-name-index')->with('status','game name  data succesfully deleted');
   }
}


