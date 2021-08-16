<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deduction;
use App\DeductionOpration;
use App\Level;
use Illuminate\Support\Facades\DB;

class DeductionController extends BaseController
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
	    $deduction = Deduction::all();
        return view("admin.staff.data.deductions", compact('deduction'));
    }

    public function deductionpage(){
        return view("admin.staff.data.staffDeduction");
    }

    public function create(Request $request)
    {
        $request->validate([
                'deduction' => 'required|max:255',
                'amount' => 'required',
        ]);	

        $bonus = new Deduction();        
        $bonus->deduction = $request->deduction;
        $bonus->amount = $request->amount;
        $saved = $bonus->save();

        if($saved)
        return redirect('/alldeduction')->with('message', 'Deduction updated successfully!.');
            else
        return redirect('/alldeduction')->with('message', 'Deduction not saved!.');
    }

    public function store(Request $request)
    {
        return null;
    }

    public function update(Request $request, $id)
    { 
        $bonus = Deduction::find($id);
        $bonus->deduction = $request->deduction;
        $bonus->amount = $request->amount;
        $saved = $bonus->save();
        if($saved)
        return redirect('/alldeduction')->with('message', 'Deduction updated successfully!.');
            else
        return redirect('/alldeduction')->with('message', 'Deduction not saved!.');
    }

    public function show(Request $request, $id)
    {
        $deduction = Deduction::find($id);
	return view("admin.staff.data.editDeduction", compact('deduction'));
    }

    public function destroy(Request $request, $id)
    {
        $deleted = Deduction::find($id)->delete();
        return redirect()->back()->with('message', $deleted ? 'Deleted successfully!.' : 'Error deleting status!.');
/*
	$status = Status::all();
        return view("admin.staff.data.viewStatus", compact('status'));
*/
    }

    public function viewPendingIncidence(Request $request)
    {
        $incidents = DeductionOpration::where('status', 'pending')
            ->orWhere('status', 'confirmed')
            ->with('staff')
            ->get();
        return view('admin.deduction-list', compact('incidents'));
    }

    public function approve(Request $request)
    {
        $incident = DeductionOpration::where('id', $request->id)
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
        $incident = DeductionOpration::where('id', $request->id)
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
        $incident = DeductionOpration::whereIn('id', $items)->update(['status' => $status]);

        return redirect()->back()->with('success', 'The User has been ' . $status);
    }
}

