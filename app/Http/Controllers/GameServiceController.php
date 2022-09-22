<?php

namespace App\Http\Controllers;

use App\Department;
use App\IncidenceOpration;
use App\Office;
use App\OfficeStock;
use App\Reason;
use App\Asset;
use App\GameService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Validator;



class GameServiceController extends Controller
{
        public function __construct()
        {
            $this->middleware('auth');
        }

          
        
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gameServiceIndex()

    {
        $gameservice = GameService::all();
        return view('admin.view-gameservice', compact('gameservice'));

        
      
        //
        // dd ($service);
    }
        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGameservice()
    {
        
       
        return view('admin.create-gameservice');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGameservice(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'game_name' =>'required',
            
        ]);
        

        $gameservice = new GameService();

        $gameservice->game_name = $request->game_name;
        // dd($gameservice);
    
        $gameservice->save();

        return redirect('view-gameservice')->with('status','gameservice data successfully inserted');
       
            
    }
    public function editGameservice($id)
    {
        // dd($id);
        $gameservice = GameService::find($id);
        // var_dump($gameservice);die();
        // dd($gameservice);
        return view('admin.edit-gameservice',compact('gameservice'));
        //
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateGameservice(Request $request, $id)
    {
        $gameservice  = GameService::find($id);
        $gameservice->game_name = $request->game_name;
       
         //store data
        
       
         $gameservice->save();
       
     
            return redirect('view-gameservice')->with('status','gameservice updated succesfully ');

    }
    public function deleteGameservice(Request $request)
    {
    
        $id = $request->id;
        $gameservice  = GameService::find($id);
        $gameservice  ->delete();
        return redirect()->back()->with('status','gameservice  data succesfully deleted');
    }
        

        //
    

}