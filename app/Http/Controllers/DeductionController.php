<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deduction;
use App\Level;
use Illuminate\Support\Facades\DB;

class DeductionController extends Controller
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
}

