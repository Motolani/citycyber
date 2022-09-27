<?php

namespace App\Http\Controllers;

use App\Office;
use App\CablePlan;
use App\CableType;
use App\CableProvider;
use App\CableSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CableSubscriptionController extends Controller
{
    public function subscriptionIndex()
    {

        // $cableplan = CablePlan::all();
         $cablesubscription = CableSubscription::orderBy('id', 'desc')->get();
         return view('admin.subscription.subscription-cable-index',compact('cablesubscription'));
    }
    public function createCableSupscription()
    {
        $cableproviders =\App\CableProvider::all();
        $cabletype = \App\CableType::all();
        $getPlan = \App\CablePlan::all();
        $getOffice = \App\Office::all();
        return view('admin.subscription.create-cable-subscription',compact('cabletype','getPlan','getOffice','cableproviders'));
    }

    public function storeCableSubscription(Request $request)
    {
         //validate data
         $this->validate($request,[
            'branch_office'=>'required',
            'cable_plan'=>'required',
            'cable_tv_type'=>'required',
            'smart_card'=>'required',
            'amount'=>'required',
            'subscription_date',
            'expiring_date'=>'required',
            'remarks'=>'required',
         ]);
         // collect data
         $cablesubscription = new CableSubscription([
          "branch_office"=> $request->input('branch_office'),
          "cable_plan" => $request->input('cable_plan'),
          "cable_tv_type" => $request->input('cable_tv_type'),
          "smart_card"=> $request->input('smart_card'),
          "amount" => $request->input('amount'),
          "subscription_date" => $request->input('subscription_date'),
          "expiring_date" => $request->input('expiring_date'),
          "remarks" => $request->input('remarks')
         ]);
       
         //store data
    
         $cablesubscription->save();
       
          //redirect to index page
        return redirect('/subscription-cable-index')->with('status','cable subscription  data  succesfully inserted');
    }

    public function editCableSubscription($id)
    {
        $cablesubscription = CableSubscription::find($id);
       return view('admin.subscription.edit-cable-subscription',compact('cablesubscription'));
    }

    public function updateCableSubscription(Request $request)
    {
        // find the object by  the id
        $cablesubscription = CableSubscription::find($request->id);
         // collect data
         $cablesubscription->branch_office = $request->input('branch_office');
         $cablesubscription->cable_plan = $request->input('cable_plan');
         $cablesubscription->cable_tv_type = $request->input('cable_tv_type');
         $cablesubscription->smart_card= $request->input('smart_card');
         $cablesubscription->amount = $request->input('amount');
         $cablesubscription->subscription_date = $request->input('subscription_date');
         $cablesubscription->expiring_date = $request->input('expiring_date');
     
         $cablesubscription->remarks = $request->input('remarks');
         //store data
    
         $cablesubscription->save();
       
          //redirect to index page
        return redirect('/subscription-cable-index')->with('status','cable subscription  data  succesfully updated');
    }

     //delete function
   public function deleteCableSubscription($id)
   {
    $cablesubscription = CableSubscription::find($id);
    $cablesubscription->delete();
      //redirect to index page
      return redirect('/subscription-cable-index')->with('status','cable subscription  data succesfully deleted');
   }
}
