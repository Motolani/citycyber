<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allowance;
use App\AllowanceOpration;
use App\Level;
use App\Office;
use Illuminate\Support\Facades\DB;

class AllowanceController extends BaseController
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
    public function allowance(){
	$staffLevel = Level::all();
	$offices = Office::all();
	return view("admin.staff.data.staffallowance", compact('offices','staffLevel'));
    }

    public function index()
    {
/*
	    $allowance = DB::table('allowance')
                    ->join('users', 'users.id', '=', 'allowance.staffid')
        
	            ->get();*/
	$staffLevel = Level::all();
        $offices = Office::all();
        $allowance = Allowance::all();
	return view("admin.staff.data.allAllowance", compact('allowance','offices','staffLevel'));
    }

    public function create(Request $request)
    {
        $request->validate([
                'allowance' => 'required|max:255',
                'level' => 'required|max:255',
                //'staffid' => 'required',
                'amount' => 'required',
                'restriction' => 'required|max:255',
                'durationbased' => 'required|max:255',
        ]);	

        $allowance = new Allowance();        
        $allowance->allowance = $request->allowance;
        $allowance->level = $request->level;
        //$allowance->staffid = $request->staffid;
        $allowance->amount = $request->amount;
        $allowance->restriction = $request->restriction;
        $allowance->durationbased = $request->durationbased;
        $saved = $allowance->save();

        if($saved)
        return redirect('/allallowances')->with('message', 'Allowance updated successfully!.');
            else
        return redirect('/allallowances')->with('message', 'Allowance not saved!.');
    }

    public function store(Request $request)
    {
        return null;
    }

    public function update(Request $request, $id)
    { 
        $allowance = Allowance::find($id);
        $allowance->allowance = $request->allowance;
        $allowance->level = $request->level;
        //$allowance->staffid = $request->staffid;
        $allowance->amount = $request->amount;
        $allowance->restriction = $request->restriction;
        $allowance->durationbased = $request->durationbased;
        $saved = $allowance->save();
        if($saved)
        return redirect('/allallowances')->with('message', 'Allowance updated successfully!.');
            else
        return redirect('/allallowances')->with('message', 'Allowance not saved!.');
    }

    public function show(Request $request, $id)
    {
        $allowance = Allowance::find($id);
	$staffLevel = Level::all();
        $offices = Office::all();	
	return view("admin.staff.data.editAllowance", compact('offices','staffLevel','allowance'));//compact('allowance'));
    }

    public function destroy(Request $request, $id)
    {
        $deleted = Allowance::find($id)->delete();
        return redirect()->back()->with('message', $deleted ? 'Deleted successfully!.' : 'Error deleting status!.');
/*
	$status = Status::all();
        return view("admin.staff.data.viewStatus", compact('status'));
*/
    }

    public function viewPendingIncidence(Request $request)
    {
        $incidents = AllowanceOpration::where('status', 'pending')
            ->orWhere('status', 'confirmed')
            ->with('staff')
            ->get();
        return view('admin.allowance-list', compact('incidents'));
    }

    public function approve(Request $request)
    {
        $incident = AllowanceOpration::where('id', $request->id)
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
        $incident = AllowanceOpration::where('id', $request->id)
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
        $incident = AllowanceOpration::whereIn('id', $items)->update(['status' => $status]);

        return redirect()->back()->with('success', 'The User has been ' . $status);
    }

}

