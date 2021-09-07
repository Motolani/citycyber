<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus;
use App\BonusOpration;
use App\Level;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SweetAlert;

class BonusController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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


    public function viewCreateBonus(Request $request){
        $bonuses = \App\Bonus::all();//dd($offences);
        $user_id = $request->user_id;//dd($request);
        $users = \App\User::where('id',$user_id)->first();	
        $bonusOperation = \App\BonusOpration::join('offices','offices.id','bonusoprations.branch_id')
                        //->join('departments','departments.id','')
			->join('bonus','bonus.id','bonusoprations.bonus_id')
            ->join('users','users.id','bonusoprations.staff_id')
            ->where('bonusoprations.staff_id',$user_id)
            ->select('users.*','offices.name as officename','bonus.bonus','bonus.amount','bonusoprations.comment','bonusoprations.created_at as date','bonusoprations.status as bonusStatus')
            ->get();
	    //dd($bonusOperation);
        if(isset($request->submit) && $request->submit == 'createBonus'){
                $message = "created";
                $user_id = $request->user_id;
                //dd($request);

		$bonuses = new \App\BonusOpration([
                        "branch_id"=>$users->branchId,
                        "bonus_id"=>$request->bonus_id,
                        "staff_id"=>$user_id,
                        "comment"=>$request->comment,
                        "issuer_id"=>Auth::user()->id,

                ]);
                $bonuses->save();
                alert()->success('Bonus Created Successfully', '');
		return redirect()->back()->with("message",'Bonus Created Successfully');
                //return view('admin.staff.operations.viewBonus',compact(['bonuses','message','user_id']));

        }
        return view('admin.staff.operations.viewBonus',compact(['bonuses','bonusOperation','user_id']));

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

    public function viewPendingIncidence(Request $request)
    {
        //dd($request);
        $incidents = BonusOpration::where('status', 'pending')
            ->orWhere('status', 'confirmed')
            ->with('staff')
            ->get();
        return view('admin.bonus-list', compact('incidents'));
    }

    public function approve(Request $request)
    {
        $incident = BonusOpration::where('id', $request->id)
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
        $incident = BonusOpration::where('id', $request->id)
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
        $incident = BonusOpration::whereIn('id', $items)->update(['status' => $status]);

        return redirect()->back()->with('success', 'The User has been ' . $status);
    }
}

