<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;

class StaffStatusController extends Controller
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
	$status = Status::all();
        return view("admin.staff.data.viewStatus", compact('status'));
    }

    public function create(Request $request)
    {
	$request->validate([
    	    'title' => 'required|max:255',
	]);	

	$status = new Status();
	$status->title = $request->title;
	$status->save();

	$status = Status::all();

        return view('admin.staff.data.viewStatus', compact("status"));
    }

    public function store(Request $request)
    {
        return null;
    }

    public function update(Request $request, $id)
    { 
	$status = Status::find($id);
	$status->title = $request->title;
	$saved = $status->save();
	if($saved)
	return redirect('/staffstatus')->with('message', 'Status updated successfully!.');
     	else
	return redirect('/staffstatus')->with('message', 'Status not saved!.');
	//return Status::find($id)->fill($requst->all())->save();
    }

    public function show(Request $request, $id)
    {
        return Status::find($id);
    }

    public function destroy(Request $request, $id)
    {
        $deleted = Status::find($id)->delete();
	return redirect()->back()->with('message', $deleted ? 'Deleted successfully!.' : 'Error deleting status!.');
/*
	$status = Status::all();
        return view("admin.staff.data.viewStatus", compact('status'));
*/
    }
}
