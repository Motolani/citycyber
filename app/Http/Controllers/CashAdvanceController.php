<?php
namespace App\Http\Controllers;

use App\CashAdvanceCategory;
use App\CashAdvanceRequest;
use App\DeductionOpration;
use App\PettyCashRequest;
use Illuminate\Http\Request;
use App\Department;
use App\IncidenceOpration;
use App\Office;
use Illuminate\Support\Facades\Auth;
use App\User;

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
        $items =CashAdvanceRequest::where('staff_id', Auth::user()->id)->get();
        return view('admin.cash-advance.my-requests-list', compact('items'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'staff_id' => 'required',
            'category' => 'required',
        ]);
        
        $category = CashAdvanceCategory::find($request->category);
        
        $staff_id = $request->staff_id;
        $staffRow = User::where("id", $staff_id)->first();
        $name = $staffRow->firstname . " " . $staffRow->middlename . " " . $staffRow->lastname;
        $cashAdvance = new CashAdvanceRequest();
        
        $office = Office::find($staffRow->office_id);
        // $cashAdvance->amount = $request->amount;
        $cashAdvance->staff_id = $staff_id;
        $cashAdvance->issuer_id = Auth::id();
        $cashAdvance->staff_name = $name;
        $cashAdvance->office_id = $staffRow->office_id;
        $cashAdvance->office_branch = $office->name . " - " . $office->location;
        $cashAdvance->category_id = $request->category;
        $cashAdvance->category_name = $category->name;
        $cashAdvance->amount = $category->cost;
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
        $pettyCash = CashAdvanceRequest::where('ticket_id', $ticketID)->first();
        $pettyCash->balance = $request->balance;
        $pettyCash->upload_path = $path;
        $pettyCash->save();

        alert()->success('Petty Cash has been requested successfully.', 'Successful');
        return redirect()->back()->with('message', 'Petty Cash has been requested successfully');
    }

    public function viewPending(Request $request)
    {
    
        $items = CashAdvanceRequest::join('offices','offices.id','cash_advance_requests.office_id')
            ->join('users as staff', 'staff.id', 'cash_advance_requests.staff_id')
            ->join('cash_advance_categories','cash_advance_categories.id','cash_advance_requests.category_id')
            ->select('cash_advance_requests.*', 'offices.name as officename', 'offices.location as officelocation', 'staff.*', 'cash_advance_categories.name as categoryname', 'cash_advance_categories.cost as categorycost')
            ->where('cash_advance_requests.status', 'pending')
            ->orWhere('cash_advance_requests.status', 'cancelled')
            ->get();
            
            // dd($items);
        // $items = CashAdvanceRequest::where('status', 'pending')
        //     ->orWhere('status', 'cancelled')
        //     ->with('staff')
        //     ->get();
        return view('admin.cash-advance.pending-list', compact('items'));
    }

    public function retireForm($id)
    {
        $data = CashAdvanceRequest::find($id);
	$branches = \App\Office::all();        
        // dd($data);
        return view('admin.cash-advance.retire-cashadvance',compact(['branches', 'data']));
    }
    
    public function retirementStore(Request $request)
    {
        # code...
        // dd($request);
        $request->validate([
            'description' => 'required',
            'file' => 'max:2048',
        ]);
        
        // dd($request->file);
        
        // $fileName = "fileName".time().'.'.request()->fileToUpload->getClientOriginalExtension();
        // $path = $request->file->move('uploads', $fileName);

	if($request->file('file')->getClientOriginalName()){	
        	$fileName = time().'_'.$request->file('file')->getClientOriginalName();
	}

        $path = $request->file('file')->storeAs('uploads', $fileName, 'public');
        
        $description = $request->description;
        
        $cashAdvance = CashAdvanceRequest::where('id', $request->cash_advance_id)
            ->update([
                "upload_path" => '/storage/' . $path,
                "status" => "retired",
                "retired_description" => $description,
                "remark" => "approved",
            ]);
        
        alert()->success('Success.', 'Successful');
        return redirect('my-requests')->with('message', 'successful');
    }

    public function viewCreate(Request $request)
    {

	$branches = \App\Office::all();	    
        $categories = CashAdvanceCategory::latest()
            ->get();
        return view('admin.cash-advance.create', compact('branches', 'categories'));
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
        $incident = CashAdvanceRequest::where('id', $request->id)->first();


        //TODO: Check if this is a super admin and update status codes accordingly
        //Check if the incident isvalid
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
        $incident = CashAdvanceRequest::where('id', $request->id)
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
     public function doDeleteRequest(Request $request){
        CashAdvanceRequest::where('id', $request->id)->delete();

        alert()->success("The Cash request have been successfully deleted", 'Success');
        return redirect()->back();
    }
}

