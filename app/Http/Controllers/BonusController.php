<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus;
use App\Level;
use Illuminate\Support\Facades\DB;

class BonusController extends Controller
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
	    $bonus = Bonus::all();
        return view("admin.staff.data.allbonus", compact('bonus'));
    }

    public function bonuspage(){
        return view("admin.staff.data.staffBonus");
    }

    public function create(Request $request)
    {
        $request->validate([
                'bonus' => 'required|max:255',
                'amount' => 'required',
        ]);	

        $bonus = new Bonus();        
        $bonus->bonus = $request->bonus;
        $bonus->amount = $request->amount;
        $saved = $bonus->save();

        if($saved)
        return redirect('/allbonuses')->with('message', 'Bonus updated successfully!.');
            else
        return redirect('/allbonuses')->with('message', 'Bonus not saved!.');
    }

    public function store(Request $request)
    {
        return null;
    }

    public function update(Request $request, $id)
    { 
        $bonus = Bonus::find($id);
        $bonus->bonus = $request->bonus;
        $bonus->amount = $request->amount;
        $saved = $bonus->save();

        if($saved)
        return redirect('/allbonuses')->with('message', 'Bonus updated successfully!.');
            else
        return redirect('/allbonuses')->with('message', 'Bonus not saved!.');
    }

    public function show(Request $request, $id)
    {
       $bonus = Bonus::find($id);
       return view("admin.staff.data.editBonus", compact('bonus'));
    }

    public function destroy(Request $request, $id)
    {
        $deleted = Bonus::find($id)->delete();
        return redirect()->back()->with('message', $deleted ? 'Deleted successfully!.' : 'Error deleting status!.');
/*
	$status = Status::all();
        return view("admin.staff.data.viewStatus", compact('status'));
*/
    }
}

