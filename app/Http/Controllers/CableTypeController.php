<?php

namespace App\Http\Controllers;

use App\CableType;
use Illuminate\Http\Request;

class CableTypeController extends Controller
{
    //
    public function cableTypeIndex()
    {

         $cabletype = CableType::orderBy('created_at','DESC')->get();
         return view('admin.cabletype.cable-type-index',compact('cabletype'));
    }

    public function createcableTypePlan()
    {

        return view('admin.cabletype.create-cable-type');
    }

    public function storecableTypePlan(Request $request)
    {
       
         //validate data
         $this->validate($request,[
            'cable_type_name'=>'required',
         ]);
         // collect data
         $cabletype = new CableType([
           "cable_type_name"=> $request->input('cable_type_name')
         ]);
         //store data
         $cabletype->save();
          //redirect to index page
        return redirect('cable-type-index')->with('status','cable  type data  succesfully inserted');
    }

    public function editcableTypePlan($id)
    {
        $cabletype = CableType::find($id);
       return view('admin.cabletype.edit-cable-type',compact('cabletype'));
    }

    public function updatecableTypePlan(Request $request)
    {
         // collect data
    
         $cabletype  =  CableType::find($request->id);
         $cabletype->cable_type_name = $request->input('cable_type_name');
           //store data
        $cabletype->save();
       
          //redirect to index page
        return redirect('cable-type-index')->with('status','cable type data updated  succesfully ');
    }

   //delete function
   public function deletecableTypePlan($id)
   {
     $cabletype = CableType::find($id);
     $cabletype->delete();
      //redirect to index page
      return redirect('/cable-type-index')->with('status','cable type data succesfully deleted');
   }
}
