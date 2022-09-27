<?php

namespace App\Http\Controllers;

use App\Department;
use App\IncidenceOpration;
use App\Office;
use App\OfficeStock;
use App\Reason;
use App\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Validator;



class BranchController extends Controller
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
    public function BranchIndex()

    {
        $branch = Branch::all();
        return view('admin.view-branch', compact('branch'));

        
      
        //
        // dd ($service);
    }
        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBranch()
    {
        
       
        return view('admin.create-branch');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBranch(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type' =>'required',
            
        ]);
        

        $branch = new Branch();

        $branch->type = $request->type;
        // dd($asset);
    
        $branch->save();

        return redirect('view-branch')->with('status','branch data successfully inserted');
       
            
    }
    public function editBranch($id)
    {
        // dd($id);
        $branch = Branch::find($id);
        // var_dump($branch);die();
        // dd($branch);
        return view('admin.edit-branch',compact('branch'));
        //
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBranch(Request $request, $id)
    {
        $branch  = Branch::find($id);
        $branch->type = $request->type;
       
         //store data
        
       
         $branch->save();
       
     
            return redirect('view-branch')->with('status','branch updated succesfully ');

    }
    public function deleteBranch(Request $request)
    {
    
        $id = $request->id;
        $branch  = Branch::find($id);
        $branch  ->delete();
        return redirect()->back()->with('status','branch  data succesfully deleted');
    }
        

        //
    

}