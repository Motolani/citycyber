<?php
namespace App\Http\Controllers;

use App\AdvanceOpration;
use App\Damages;
use Illuminate\Http\Request;
use App\Deduction;
use App\Level;
use App\IncidenceOpration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LossDamageController extends BaseController
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


    public function homeTest(Request $request)
    {
        dd($request);
    }

    public function viewPendingIncidence(Request $request)
    {
        $incidents = AdvanceOpration::where('status', 'pending')
            ->orWhere('status', 'confirmed')
            ->with('staff')
            ->get();
        return view('admin.loss-damage-list', compact('incidents'));
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
        alert()->success('Successfully Approved.', 'Success');
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
        alert()->success('Successfully Denied.', 'Success');
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

        alert()->success("The user have been $status", 'Success');
        return redirect()->back()->with('success', 'The User has been ' . $status);
    }
    
    
    public function viewOtherLoans(){

        $branches = \App\Office::all();
        return view('admin.staff.operations.createOtherLoan',compact(['branches']));
    
    }
    
    public function storeOtherLoan(Request $request)
    {   
        Log::info($request);
        
        $today = Carbon::now()->toDateString();
        $validator = Validator::make($request->all(), [
            'staff_id' => 'required',
            'amount' => 'required',
            'propertyLost' => 'required',
            'type' => 'required',
            // 'comment' => 'required',
            'comment' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }
        
        $issuer_id = Auth::user()->id;
        // $staff = \App\User::where('id', $request->staff_id)->first();
        $staff_id = $request->staff_id;
        $comment = $request->comment;
        $propertyLost = $request->propertyLost;
        $amount = $request->amount;
        $branch_id = $request->branch_id;
        $type = $request->type;
        
        $dam = new Damages();
        $dam->branch_id = $branch_id;
        $dam->staff_id = $staff_id;
        $dam->comment = $comment;
        $dam->amount = $amount;
        $dam->property_lost = $propertyLost;
        $dam->issuer_id = $issuer_id;
        $dam->type = $type;
        
        $saved = $dam->save();
        
        if($saved){
            return redirect()->back()->with("message",'Damages Loan Request Created Successfully');
        }else{
            return redirect()->back()->with("error",'Failed to Create Damages Loan Request');
        }
    }
    
    public function viewlossdamage()
    {
        # code...
        $lossdamage = Damages::join('officelevels','officelevels.level','lossdamageoperations.branch_id')
            ->join('users as staff', 'staff.id', 'lossdamageoperations.staff_id')
            ->join('users as issuer', 'issuer.id', 'lossdamageoperations.issuer_id')
            ->join('offices', 'offices.id', 'staff.office_id')
            ->select('lossdamageoperations.*', 'officelevels.name as officelevelname', 'staff.*', 'issuer.email as issuer', 'offices.name as officename', 'lossdamageoperations.status as opstat', 'lossdamageoperations.type as damageType')
            ->get();
            
            // dd($lossdamage);
            
            return view('admin.staff.operations.viewOtherLoan', compact('lossdamage'));
    }
}


