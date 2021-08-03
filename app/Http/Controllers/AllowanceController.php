<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allowance;
use App\Level;
use App\Office;
use Illuminate\Support\Facades\DB;

class AllowanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
}

