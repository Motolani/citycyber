<?php

namespace App\Http\Controllers;

use App\IncidenceOpration;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use App\SuspensionOpration;
use Carbon\Carbon;
use SweetAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SuspensionController extends BaseController
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


    


//     public function viewCreateSuspension(Request $request){
//         //$bonuses = \App\Suspension::all();//dd($offences);
//         $user_id = $request->user_id;//dd($request);
// 	    $users = \App\User::where('id',$user_id)->first();
//         //dd($request);	
// 	    $suspensions = \App\SuspensionOpration::join('offices','offices.id','suspensionoprations.branch_id')
// 			->join('users','users.id','suspensionoprations.staff_id')	
// 			->where('suspensionoprations.staff_id',$user_id)
// 			->select('users.*','offices.name as officename','suspensionoprations.comment','suspensionoprations.startDate','suspensionoprations.endDate','suspensionoprations.status')
// 			->get();
// 			//dd($suspensions);
//         if(isset($request->submit) && $request->submit == 'createSuspension'){
//                 $message = "created";
//                 $user_id = $request->user_id;
// 		//dd($request);
//             $suspension = new \App\SuspensionOpration([
//                 "branch_id"=>$users->branchId,
//                 "startDate"=>$request->startDate,
//                 "endDate"=>$request->endDate,
//                 "staff_id"=>$user_id,
//                 "comment"=>$request->comment,
//                 "issuer_id"=>Auth::user()->id,

//             ]);
// 		$suspension->save();
//                 //dd($request);
// 		$suspensions = \App\SuspensionOpration::join('offices','offices.id','suspensionoprations.branch_id')
//             //->join('departments','departments.id','')
//             ->join('users','users.id','suspensionoprations.staff_id')
//             ->where('suspensionoprations.staff_id',$user_id)
//             ->select('users.*','offices.name as officename','suspensionoprations.comment','suspensionoprations.startDate','suspensionoprations.endDate','suspensionoprations.status')
//             ->get();
//             //dd($suspensions);
//             alert()->success('Suspension Created Successfully', '');
// 			return redirect()->back()->with("message",'Suspension Created Successfully');
//                 //return view('admin.staff.operations.viewSuspension',compact(['message','suspensions','user_id']));

//         } 
//         return view('admin.staff.operations.viewSuspension',compact(['user_id','suspensions']));
          
//    }  


    
    public function viewCreateSuspension(){

        //$branches = \App\OfficeLevel::whereIn('level', [6,7,8])->get();
	$branches = \App\Office::all();    
	return view('admin.staff.operations.createSuspension',compact(['branches']));
    
    }
    
    public function getStaff($branch_id)
        {
            $staff = \App\User::where('branchId',$branch_id)->get();
            return response()->json([
    			"data"=>$staff,
    			"status"=>"200",
    		]);
        }
    
    
    public function storeSuspension(Request $request)
    {   
        Log::info($request);
        
        $today = Carbon::now()->toDateString();
        $validator = Validator::make($request->all(), [
            'staff_id' => 'required',
            'start' => 'required|date_format:Y-m-d|before_or_equal:to|after_or_equal:'.$today,
            'end' => 'required|date_format:Y-m-d|after:time_start',
            'comment' => 'required',
        ]);
        
        if ($validator->fails()) {
            // return response()->json(['required_fields' =>$validator->errors()->all(),
            //     'message' =>'Missing field(s) | Validation Error',
            //     'status'=>'100']);
                return redirect()->back()
                    ->withErrors($validator);
        }
        
        $issuer_id = Auth::user()->id;
        // $staff = \App\User::where('id', $request->staff_id)->first();
        $staff_id = $request->staff_id;
        $comment = $request->comment;
        $start = $request->start;
        $finish = $request->end;
        $branch_id = $request->branch_id;
        
        $sus = new SuspensionOpration();
        $sus->branch_id = $branch_id;
        $sus->staff_id = $staff_id;
        $sus->comment = $comment;
        $sus->startDate = $start;
        $sus->endDate = $finish;
        $sus->issuer_id = $issuer_id;
        $saved = $sus->save();
        
        // alert()->success('Incidence Created Successfully', '');
        
        if($saved){
            return redirect()->back()->with("message",'Suspension Request Created Successfully');
        }else{
            return redirect()->back()->with("error",'Failed to Create Suspension Request');
        }
    }
    
    public function viewSuspensions()
    {
        # code...
        $suspension = SuspensionOpration::join('offices','offices.id','suspensionoprations.branch_id')
            ->join('users as staff', 'staff.id', 'suspensionoprations.staff_id')
            ->join('users as issuer', 'issuer.id', 'suspensionoprations.issuer_id')
            ->select('suspensionoprations.*', 'staff.*', 'issuer.email as issuer', 'offices.name as officename', 'suspensionoprations.status as opstat')
            ->get();
            
            // dd($suspension);
            
            return view('admin.staff.operations.newViewSuspension', compact('suspension'));
    }

    public function viewPendingIncidence(Request $request)
    {
        $incidents = SuspensionOpration::where('status', 'pending')
            ->orWhere('status', 'confirmed')
            ->with('staff')
            ->get();
        return view('admin.suspension-list', compact('incidents'));
    }
    
    public function homeTest(Request $request)
    {
        dd($request);
    }

    public function approve(Request $request)
    {
        $incident = IncidenceOpration::where('id', $request->id)
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
            $incident->status = 'confirmed';
            $incident->save();
        }
        return redirect()->back()->with('success', 'Successfully Approved');
    }


    public function deny(Request $request)
    {
        $incident = IncidenceOpration::where('id', $request->id)
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
            $incident->status = 'cancelled';;
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
