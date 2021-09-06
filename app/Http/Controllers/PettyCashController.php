<?php
namespace App\Http\Controllers;

use App\DeductionOpration;
use App\PettyCashRequest;
use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\Auth;

class PettyCashController extends BaseController
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
    }

    public function myRequests()
    {
        $items = PettyCashRequest::where('staff_id', Auth::user()->id)->get();
        return view('admin.pettycash.my-requests-list', compact('items'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'amount' => 'required|max:255',
        ]);
        $pettyCash = new PettyCashRequest();
        $ticketID = $pettyCash->generateTicketID();
        $pettyCash->ticket_id = $ticketID;
        $pettyCash->amount = $request->amount;
        $pettyCash->staff_id = Auth::user()->id;
        $pettyCash->description = $request->description;
        $pettyCash->save();
        alert()->success('Petty Cash has been requested successfully.', 'Successful');

        return redirect()->back()->with('message', 'Petty Cash has been requested successfully');
    }

    public function submitExpense(Request $request)
    {
//        dd($request);

        $request->validate([
//            'amount' => 'required|max:255',
//            'file' => 'required|mimes:jpg,png',
        ]);

        $fileName = time().'.'.$request->file->extension();
        $path = $request->file->move(storage_path('uploads'), $fileName);
        //dd($path);


        $ticketID = $request->ticketID;
        $pettyCash = PettyCashRequest::where('ticket_id', $ticketID)->first();
        $pettyCash->balance = $request->balance;
        $pettyCash->upload_path = $path;
        $pettyCash->save();

        alert()->success('Petty Cash has been requested successfully.', 'Successful');
        return redirect()->back()->with('message', 'Petty Cash has been requested successfully');
    }

    public function viewPending(Request $request)
    {
        $items = PettyCashRequest::where('status', 'pending')
            ->orWhere('status', 'cancelled')
            ->with('staff')
            ->get();
        return view('admin.pettycash.pending-list', compact('items'));
    }

    public function update(Request $request, $id)
    {
        $department = Department::find($id);
        $department->title = $request->title;
        $saved = $department->save();
        if($saved)
            return redirect()->back()->with('message', 'Department is updated successfully');
        else
            return redirect()->back()->with('message', 'Error updating department');;
        //return Department::find($id)->fill($requst->all())->save();
    }


    public function viewCreate(Request $request)
    {
        return view('admin.pettycash.create');
    }

    public function viewSubmitExpense(Request $request, $id)
    {
        $data = PettyCashRequest::where('id',$id)->first();
        if(isset($data)){
            return view('admin.pettycash.submit-expense', compact('data'));
        }
        return redirect()->back()->with('error', 'The requested data was not found');
    }

    public function destroy(Request $request, $id)
    {
        $deleted = Department::find($id)->delete();
        return redirect()->back()->with('message', $deleted ? 'Deleted successfully!.' : 'Error deleting department!.');
//        return Department::find($id)->delete();
    }


    public function approve(Request $request)
    {
        $incident = PettyCashRequest::where('id', $request->id)->first();


        //TODO: Check if this is a super admin and update status codes accordingly
        //Check if the incident is valid
        if (isset($incident)) {
            //We assume this is Super Admin for Now
            $incident->status = 'approved';
            $incident->save();
        }
        return redirect()->back()->with('success', 'Successfully Approved');
    }


    public function deny(Request $request)
    {
        $incident = PettyCashRequest::where('id', $request->id)
            ->first();

        //TODO: Check if this is a super admin and update status codes accordingly
        //Check if the incident is valid
        if (isset($incident)) {
            //We assume this is Super Admin for Now
            $incident->status = 'disapproved';
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

