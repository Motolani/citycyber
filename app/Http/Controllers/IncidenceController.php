<?php

namespace App\Http\Controllers;

use App\IncidenceOpration;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Auth;
class IncidenceController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Add this line to call Parent Constructor from BaseController
        parent::__construct();

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }
	/*
    public function viewCreateIncidence(Request $request){
        $offences = \App\Offence::all();//dd($offences);
        $user_id = $request->user_id;//dd($request);
    
        $users = \App\User::where('id',$user_id)->first(); 
        $offenceRaised = \App\IncidenceOpration::join('offices','offices.id','incidenceoprations.branch_id')
                //->join('departments','departments.id','')
                ->join('offences','offences.id','incidenceoprations.offence_id')
                ->join('users','users.id','incidenceoprations.staff_id')
                ->where('incidenceoprations.staff_id',$user_id)
                ->select('users.*','offices.name as officename','offences.name as offencename','offences.amount','incidenceoprations.comment','incidenceoprations.created_at as date','incidenceoprations.status as offenceStatus')
                ->get();//dd($offenceRaised);
        if(isset($request->submit) && $request->submit == 'createOffence'){
            $message = "created";
            $user_id = $request->user_id;
            //dd($request);
            $offences = new \App\IncidenceOpration([
                "branch_id"=>$users->branchId,
                "offence_id"=>$request->offence_id,
                "staff_id"=>$user_id,
                "comment"=>$request->comment,
                "issuer_id"=>Auth::user()->id,
    
            ]);
            $offences->save();
            alert()->success('Incidence Created Successfully', '');
            return redirect()->back()->with("message",'Offence Created Successfully');
    
            //return view('admin.staff.operations.viewIncidence',compact(['offences','message','user_id']));
    
        }
         return view('admin.staff.operations.viewIncidence',compact(['offences','offenceRaised','user_id']));	
    
       }
	*/
	
    public function viewIncidence()
    {
        $incidents = \App\IncidenceOpration::all();
        $offenceRaised = \App\IncidenceOpration::join('offices','offices.id','incidenceoprations.branch_id')
                //->join('departments','departments.id','')
                ->join('offences','offences.id','incidenceoprations.offence_id')
                ->join('users','users.id','incidenceoprations.staff_id')
                //->where('incidenceoprations.staff_id',$user_id)
                ->select('users.*','offices.name as officename','offences.name as offencename','offences.amount','incidenceoprations.comment','incidenceoprations.created_at as date','incidenceoprations.status as offenceStatus')
                ->get();
        return view('admin.staff.operations.viewIncidence', compact('incidents', 'offenceRaised'));
    }

    public function viewCreateIncidence(){
        $id = Auth::user()->id;  
        $staff = \App\User::find($id); 
        $off = \App\Office::find($staff->office_id); 
        $lev = \App\OfficeLevel::where('level', $off->level)->first();  
        $levs = explode(",", $lev->children);  //dd($lev);
        $fils = \App\OfficeLevel::whereIn('id', $levs)->get();  //dd($fils);
        


        $offences = \App\Offence::all();//dd($offences);
       // $staffs = \App\User::all(); //dd($staffs);
	    $branches = \App\Office::whereIn('level', $levs)->get(); //dd($branches);
        return view('admin.staff.operations.createIncidence',compact(['offences', 'branches', 'fils']));

    }


    public function storeIncidence(Request $request)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required',
            'offence_id' => 'required',
            'comment' => 'required',
        ]);
        $user = Auth::user()->id;
        $staff = \App\User::where('id', $request->staff_id)->first();

        $inc = new IncidenceOpration();
        $inc->branch_id = $staff->branchId;
        $inc->staff_id = $request->staff_id;
        $inc->offence_id = $request->offence_id;
        $inc->comment = $request->comment;
        $inc->issuer_id = $user;

        $inc->save();
        alert()->success('Incidence Created Successfully', '');
        return redirect()->back()->with("message",'Incidence Created Successfully');
    }


    public function getStaff($branch_id)
    {
	    dd('hello world');

	    $staff = \App\User::where('branchId',$branch_id)->get();
        return response()->json($staff);
    }




    public function homeTest(Request $request)
    {
        dd($request);
    }

    public function viewPendingIncidence(Request $request)
    {
        $incidents = IncidenceOpration::where('status', 'pending')
            ->orWhere('status', 'confirmed')
            ->with('staff')
            ->get();
        return view('admin.incidence-list', compact('incidents'));
    }

    public function approve($id)
    {
	//dd($id);
        $incident = IncidenceOpration::where('id', $id)
		->first();
	//dd($incident);

        //Status 0 - Pending
        //Status 1 - Approved from 1st Admin        
        //Status 2 - Declined by 1st Admin
        //Status 3 - Approved by Super Admin
        //Status 4 - Declined by Super Admin

        //TODO: Check if this is a super admin and update status codes accordingly

        //Check if the incident is valid
        if (isset($incident)) {
            //We assume this is Super Admin for Now
            $incident->status = 'confirmed';
            $incident->save();
        }
        return redirect()->back()->with('success', 'Successfully Approved');
    }


    public function deny($id)
    {
        $incident = IncidenceOpration::where('id', $id)
            ->first();

        //Status 0 - Pending
        //Status 1 - Approved from 1st Admin        
        //Status 2 - Declined by 1st Admin
        //Status 3 - Approved by Super Admin
        //Status 4 - Declined by Super Admin

        //TODO: Check if this is a super admin and update status codes accordingly

        //Check if the incident is valid
        if (isset($incident)) {
            //We assume this is Super Admin for Now
            $incident->status = 'cancelled';
            $incident->save();
        }
        return redirect()->back()->with('success', 'Successfully Denied');
    }


    public function bulkAction(Request $request)
    {
        $items = $request->items;
        $action = $request->action;

        //Status 0 - Pending
        //Status 1 - Approved from 1st Admin        
        //Status 2 - Declined by 1st Admin
        //Status 3 - Approved by Super Admin
        //Status 4 - Declined by Super Admin

        if ($action == "accept")
            $status = 'approved';
        else
            $status = 'disapproved';

        //TODO: Check if this is a super admin and update status codes accordingly
        $incident = IncidenceOpration::whereIn('id', $items)->update(['status' => $status]);

        return redirect()->back()->with('success', 'The User has been ' . $status);
    }
}
