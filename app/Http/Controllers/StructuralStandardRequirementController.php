<?php

namespace App\Http\Controllers;

use App\Department;
use App\IncidenceOpration;
use App\Office;
use App\OfficeStock;
use App\Reason;
use App\StructuralStandardRequirement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Validator;



class StructuralStandardRequirementController extends Controller
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
    public function StructuralStandardIndex()

    {
        $structuralstandard = StructuralStandardRequirement::all();
        return view('admin.viewStructural-standard-requirement', compact('structuralstandard'));
      
        //
        // dd ($service);
    }
        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStructuralstandard()
    {
        
       
        return view('admin.createStructural-standard-requirement');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStructuralstandard(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'structuralstandardrequirement' =>'required',
            
        ]);
        // $databundle -> phone = $phone;
        //  "serviceName"=>$request->input('serviceName'),


       

        $structuralstandard = new StructuralStandardRequirement();

        $structuralstandard->structuralstandardrequirement = $request->structuralstandardrequirement;
        // dd($structuralstandard->structuralstandardrequirement);
       // dd($databundle);
        $structuralstandard->save();

        return redirect('viewStructural-standard-requirement')->with('status','structuralstandardrequirement data successfully inserted');

            
    }
    public function editStructuralstandard($id)
    {
        // dd($id);
        $structuralstandard = StructuralStandardRequirement::find($id);
        // var_dump($databundle);die();
        // dd($structuralstandard);
        return view('admin.edit-structuralstandard',compact('structuralstandard'));
        //
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStructuralstandard(Request $request, $id)
    {
        $structuralstandard  = StructuralStandardRequirement::find($id);
        $structuralstandard->structuralstandardrequirement = $request->input('structuralstandardrequirement');
       
         //store data
        
       
         $structuralstandard->save();
       
     
            return redirect('viewStructural-standard-requirement')->with('status','structuralstandard updated succesfully ');

    }
    public function deleteStructuralstandard(Request $request)
    {
    
        $id = $request->id;
        $structuralstandard  = StructuralStandardRequirement::find($id);
        $structuralstandard  ->delete();
        return redirect()->back()->with('status','structuralstandard  data succesfully deleted');
    }
        

        //
    

}
