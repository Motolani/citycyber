<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lateness;
use App\Level;
use Illuminate\Support\Facades\DB;

class LatenessController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
                //Add this line to call Parent Constructor from BaseController
                // parent::__construct();

        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
	    $lateness = Lateness::all();
        return view("admin.staff.data.allLateness", compact('lateness'));
    }

    public function latenesspage(){
        return view("admin.staff.data.staffLateness");
    }

    public function create(Request $request)
    {
        $request->validate([
                'starthour' => 'required|max:255',
                'endhour' => 'required',
                'amount' => 'required',
        ]);	

        $bonus = new Lateness();        
        $bonus->starthour = $request->starthour;
        $bonus->endhour = $request->endhour;
        $bonus->amount = $request->amount;
        $saved = $bonus->save();

        if($saved){
            alert()->success('Lateness Created Successfully', '');
        return redirect('/alllateness')->with('message', 'Lateness created successfully!.');
        }
        else{
            alert()->success('Lateness Creation Failed', '');
        return redirect('/alllateness')->with('message', 'Lateness not saved!.');
        }
    }

    public function store(Request $request)
    {
        return null;
    }

    public function update(Request $request, $id)
    { 
        $bonus = Lateness::find($id);  
        $bonus->starthour = $request->starthour;
        $bonus->endhour = $request->endhour;
        $bonus->amount = $request->amount;
        $saved = $bonus->save();

        if($saved)
        return redirect('/alllateness')->with('message', 'Lateness created successfully!.');
        else
        return redirect('/alllateness')->with('message', 'Lateness not saved!.');
    }

    public function show(Request $request, $id)
    {
        $lateness = Lateness::find($id);
	return view("admin.staff.data.editLateness", compact('lateness'));
    }

    public function destroy(Request $request, $id)
    {
        $deleted = Lateness::find($id)->delete();
        return redirect()->back()->with('message', $deleted ? 'Deleted successfully!.' : 'Error deleting status!.');
/*
	$status = Status::all();
        return view("admin.staff.data.viewStatus", compact('status'));
*/
    }
}

