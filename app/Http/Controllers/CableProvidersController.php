<?php

namespace App\Http\Controllers;
use App\CablePlan;
use App\CableProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Core\Offices;


class CableProvidersController extends Controller
{
    //
    // public function __construct()
    // {
    //     //Add this line to call Parent Constructor from BaseController
    //    parent::__construct();

       //$this->middleware('auth');
    // }

    public function index()
    {
     
       
        $cableprovider = DB::table('cable_providers')
                         ->join('offices','offices.name','=','cable_providers.branch_office')
                         ->select('offices.name','offices.type','cable_providers.id','cable_providers.cable_tv_type',
                         'cable_providers.cable_plan_type','cable_providers.smart_card','cable_providers.created_at')
                         ->orderBy('id', 'DESC')
                         ->get();
                    //dd($cableprovider);
                       return view('admin.cable.cable-index',compact('cableprovider'));   
        // $cableprovider = CableProvider::all();
        // $cableprovider = CableProvider::paginate(4);
        // return view('admin.cable.cable-index',compact('cableprovider'));
    }

    public function createCableProviders()
    {
   
       $cable_tv = \App\CableType::all();
       $getPlan = \App\CablePlan::all();
       $getOffice = \App\Office::all();
        return view('admin.cable.create-cable-providers',compact('getOffice','getPlan','cable_tv'));
    }

   //  public function GetAllPlan()
   //  {
   //    $plans = new CablePlan();
   //    $getPlan = $plans->GetAllPlan();
   //    return view('admin.cable.create-cable-providers',compact('getPlan'));
   //  }

    public function storeCableProviders(Request $request)
    {
        
         //validate data
         $this->validate($request,[
            'branch_office'=>'required',
            'cable_tv_type'=>'required',
            'cable_plan_type'=>'required',
            'smart_card'=>'numeric',
         ]);
         // collect data
         $cableprovider  = new CableProvider([
            "branch_office"  =>$request->input('branch_office'),
            "cable_tv_type"  =>$request->input('cable_tv_type'),
            "cable_plan_type"  =>$request->input('cable_plan_type'),
            "smart_card" =>$request->input('smart_card'),
         ]);
      
         //store data
    
         $cableprovider->save();
       
          //redirect to index page
        return redirect('cable-index')->with('status','cable  data succesfully inserted');
    }

     public function editCableProviders($id)
     {
        $cableprovider = CableProvider::find($id);
        return view('admin.cable.edit-cable-providers',compact('cableprovider'));
     }

    //update function
    public function updateCableProviders(Request $request)
    {
          $cableprovider = CableProvider::find($request->id);
          // collected data
          $cableprovider->branch_office =$request->input('branch_office');
          $cableprovider->cable_tv_type =$request->input('cable_tv_type');
          $cableprovider->cable_plan_type =$request->input('cable_plan_type');
          $cableprovider->smart_card=$request->input('smart_card');
         
          // update collected data here
          $cableprovider->save();
          //redirect to index page
         return redirect('/cable-index')->with('status','cable  data succesfully updated');
    }

   //delete function
   public function deleteCableProviders($id)
   {
       $cableprovider = CableProvider::find($id);
       $cableprovider->delete();
      //redirect to index page
      return redirect('/cable-index')->with('status','cable  data succesfully deleted');
   }
    
}
