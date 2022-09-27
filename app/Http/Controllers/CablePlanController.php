<?php

namespace App\Http\Controllers;

use App\CablePlan;
use Illuminate\Http\Request;

class CablePlanController extends Controller
{
    //
    public function cablePlanIndex()
    {

        // $cableplan = CablePlan::all();
         $cableplan = CablePlan::orderBy('id', 'desc')->get();
         return view('admin.cableplan.cable-plan-index',compact('cableplan'));
    }

    public function createCablePlan()
    {
   
        return view('admin.cableplan.create-cable-plan');
    }
    public function storeCablePlan(Request $request)
    {
         //validate data
         $this->validate($request,[
            'cable_plan_name'=>'required',
            'amount'=>'required',
         ]);
         // collect data
         $cableplan  = new CablePlan([
            "cable_plan_name" => $request->input('cable_plan_name'),
            "amount" =>$request->input('amount')
         ]);
   
         //store data
    
         $cableplan->save();
       
          //redirect to index page
        return redirect('cable-plan-index')->with('status','cable  plan data  succesfully inserted');
    }

    public function editCablePlan($id)
    {
       $cableplan = CablePlan::find($id);
       return view('admin.cableplan.edit-cable-plan',compact('cableplan'));
    }

    public function updateCablePlan(Request $request)
    {
         // collect data
         $cableplan  = CablePlan::find($request->id);
         $cableplan->cable_plan_name = $request->input('cable_plan_name');
         $cableplan->amount = $request->input('amount');
         //store data
    
         $cableplan->save();
       
          //redirect to index page
        return redirect('cable-plan-index')->with('status','cable  plan data updated  succesfully ');
    }

   //delete function
   public function deleteCablePlan($id)
   {
         $cableplan = CablePlan::find($id);
         $cableplan->delete();
      //redirect to index page
      return redirect('/cable-plan-index')->with('status','cable plan  data succesfully deleted');
   }
}
