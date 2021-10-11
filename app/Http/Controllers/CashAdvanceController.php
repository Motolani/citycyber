<?php
namespace App\Http\Controllers;

use App\CashAdvanceCategory;
use App\CashAdvanceRequest;
use App\DeductionOpration;
use App\PettyCashRequest;
use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\Auth;

class CashAdvanceController extends BaseController
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
            'category' => 'required',
        ]);
        $cashAdvance = new CashAdvanceRequest();
        $cashAdvance->amount = $request->amount;
        $cashAdvance->staff_id = Auth::user()->id;
        $cashAdvance->category_id = $request->category;
        $cashAdvance->description = $request->description;
        $cashAdvance->save();

        alert()->success('Cash Advance request sent successfully.', 'Successful');
        return redirect()->back()->with('message', 'Cash Advance has been requested successfully');
    }

    public function submitExpense(Request $request)
    {
        $request->validate([
//            'amount' => 'required|max:255',
//            'file' => 'required|mimes:jpg,png',
        ]);

        $fileName = time().'.'.$request->file->extension();
        $path = $request->file->move('uploads', $fileName);
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
        return view('admin.cash-advance.pending-list', compact('items'));
    }


    public function viewCreate(Request $request)
    {
        $categories = CashAdvanceCategory::latest()
            ->get();
        return view('admin.cash-advance.create', compact('categories'));
    }

    public function viewSubmitExpense(Request $request, $id)
    {
        $data = CashAdvanceRequest::where('id',$id)->first();
        if(isset($data)){
            return view('admin.cash-advance.submit-expense', compact('data'));
        }
        alert()->error("The requested data was not found", 'Success');
        return redirect()->back()->with('error', 'The requested data was not found');
    }

    public function destroy(Request $request, $id)
    {
        $deleted = Department::find($id)->delete();

        $message = $deleted ? 'Deleted successfully!.' : 'Error deleting department!.';
        alert()->success("$message", 'Success');
        return redirect()->back()->with('message', $message);
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
        alert()->success("Successfully Approved", 'Success');
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
        alert()->success("Successfully Denied", 'Success');
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
        alert()->success("The User have been $status", 'Success');
        return redirect()->back()->with('success', 'The User has been ' . $status);
    }

    public function viewCategories(){
        $categories = CashAdvanceCategory::latest()->get();
        return view('admin.cash-advance.add-category-list', compact('categories'));
    }

    public function doAddCategory(Request $request){
        $request->validate([
            'name' => 'required|max:255|min:3',
        ]);
        $category = new CashAdvanceCategory();
        $category->name = $request->name;
        $category->save();

        alert()->success("The Category have been successfully added", 'Success');
        return redirect()->back();
    }

    public function doDeleteCategory(Request $request){
        CashAdvanceCategory::where('id', $request->id)->delete();

        alert()->success("The Category have been successfully deleted", 'Success');
        return redirect()->back();
    }
}
