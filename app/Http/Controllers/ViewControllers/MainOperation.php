<?php

namespace App\Http\Controllers\ViewControllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Offices;
use Illuminate\Http\Request;
//use ('../Core/Offices.php');
use App\Http\Controllers\Core\CreateStaffClass;
use App\Http\Controllers\Core\StaffController;

use App\Unit;
use App\EducationType;
use App\Qualification;
use App\Bank;
use App\Department;
use App\Classes;
use App\Status;
use App\ResumptionType;
use App\Level;
use App\Http\Controllers\BaseController;
use App\User;
//use Auth;
use Illuminate\Support\Facades\Auth;
class MainOperation extends BaseController
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
        return view('admin.home');
    }
    public function getLevel(Request $request){
        $getLevel = new Offices();
        $levels = $getLevel->GetAllLevels();
        //dd($levels);	
        return view('admin.createOffice')->with(["levels"=>$levels]);
    }

    public function manageAttendance(Request $request){

        if(1){
            $superAdmin = 1;
            if(isset($request->submit) && $request->submit == "cancel"){

                $update = \App\Attendance::where('staff_number',$request->staff_number)->update(['status'=>2]);
                if($update){
                    alert()->success("Cancelled Successfully", 'Success');
                    return redirect()->back()->with('message','Cancelled Successfully');
                }
            }
            if(isset($request->submit) && $request->submit == "approve"){

                $update = \App\Attendance::where('staff_number',$request->staff_number)->update(['status'=>1]);
                if($update){
                    alert()->success("Successfully Approved", 'Success');
                    return redirect()->back()->with('message','Approved Successfully');
                }
            }
            else{
                if($superAdmin){
                    $attendance = \App\Attendance::all();
                    return view('admin.staff.operations.viewAttendance',compact('attendance'));
                }else{
                    $attendance = \App\Attendance::all();
                    return view('admin.staff.operations.viewAttendance',compact('attendance'));
                }
            }
        }
    }


    public function viewLeaveRequest(Request $request){
        $user_id = $request->user_id;
        $user = User::findOrFail($user_id);
        $leaveData = \App\LeaveRequest::join('offcategories','offcategories.id','leaverequests.leavecategory_id')
            ->join('offtypes','offtypes.id', 'leaverequests.leavetype_id')
            ->join('users','users.id','leaverequests.staff_id')
            ->select('leaverequests.*','leaverequests.dates as day','users.firstname','offcategories.category','offtypes.type')

            ->where('leaverequests.staff_id',$user_id)->get();



            $leavetype = \App\OffType::all();
            $leavecategory = \App\OffCategory::all();
            $user_id = $request->user_id;
            $user = User::findOrFail($user_id);
    
    
            if(isset($request->submit)){
                //dd("herere") ;
    
                $dates = $request->dates;
                $exp = explode(",",$dates);
                $count = sizeof($exp);
                for($i = 0; $i<$count;$i++){
    
                    $offences = new \App\LeaveRequest([
                        "staff_id"=>$user_id,
                        "leavecategory_id"=>$request->leavecategory_id,
                        "leavetype_id"=>$request->leavetype_id,
                        "comment"=>$request->comment,
                        "dates"=>$exp[$i],
                    ]);
                    $offences->save();
    
                }
    
                alert()->success("Request have been submitted", 'Success');
                return redirect()->back()->with("message",'Request has been submitted');
            }
        return view('admin.staff.operations.leaveRequest',compact('leaveData', 'leavetype', 'leavecategory', 'user', 'user_id'));

        
    }



    public function returnCreateLeave(Request $request){

        //dd($request);
        $leavetype = \App\OffType::all();
        $leavecategory = \App\OffCategory::all();
        $user_id = $request->user_id;
        $user = User::where('id', $user_id);

	
        if(isset($request->submit)){
            //dd("herere") ;

            $dates = $request->dates;
            $exp = explode(",",$dates);
            $count = sizeof($exp);
            for($i = 0; $i<$count;$i++){

                $offences = new \App\LeaveRequest([
                    "staff_id"=>$user_id,
                    "leavecategory_id"=>$request->leavecategory_id,
                    "leavetype_id"=>$request->leavetype_id,
                    "comment"=>$request->comment,
                    "dates"=>$exp[$i],
                ]);
                $offences->save();

            }

            alert()->success("Request have been submitted", 'Success');
            return redirect()->back()->with("message",'Request has been submitted');
	}
	return view('admin.staff.operations.requestLeave',compact(['leavetype','leavecategory','user_id','user']));
        // return view('admin.staff.operations.leaveRequest',compact(['leavetype','leavecategory','user_id', 'user']));

    }


    public function viewSalaryAdvances()
    {
        $salaryAdvances = \App\AdvanceOpration::all();
        $advances = \App\AdvanceOpration::join('offices','offices.id','advanceoperations.branch_id')
            ->join('users','users.id','advanceoperations.staff_id')
            //->where('advanceoperations.staff_id',$user_id)
            ->select('users.*','offices.name as officename','advanceoperations.amount','advanceoperations.comment','advanceoperations.created_at','advanceoperations.startDate','advanceoperations.endDate','advanceoperations.status as datastatus')
            ->get();
        return view('admin.staff.operations.viewAdvance',compact(['advances']));
    }


    public function viewCreateAdvance()
    {
        $branches = \App\Office::whereIn('level', [6,7,8])->get();
        return view('admin.staff.operations.createAdvance',compact(['branches']));
    }


    public function storeAdvance(Request $request)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required',
            'amount' => 'required',
            'endStart' => 'required',
            'endEnd' => 'required',
            'comment' => 'required',
        ]);
        $user = Auth::user()->id;
        $staff = \App\User::where('id', $request->staff_id)->first();

        $advance = new \App\AdvanceOpration([
            "branch_id"=>$staff->branchId,
            "startDate"=>$request->endStart,
            "endDate"=>$request->endEnd,
            "staff_id"=>$request->staff_id,
            "comment"=>$request->comment,
            "issuer_id"=>Auth::user()->id,
            "amount"=>$request->amount,

        ]);

        $advance->save();
        alert()->success('Advance Created Successfully', '');
        return redirect()->back()->with("message",'Advance Created Successfully');
    }

    public function viewCreateStaffLoanList(Request $request){

        $loans = \App\LoanOpration::select('users.*','offices.name as officename','loanoprations.comment','loanoprations.status','repaymenttypes.repaymentName','loantypes.loanName')
                ->leftJoin('offices','offices.id','loanoprations.branch_id')
                ->leftJoin('users','users.id','loanoprations.staff_id')
                ->leftJoin('repaymenttypes', 'repaymenttypes.id', 'loanoprations.repaymentId')
                ->leftJoin('loantypes', 'loantypes.id', 'loanoprations.loanTypeId')
                ->get();
        $repaymentTypes = \App\RepaymentType::all();
        $loanTypes = \App\LoanType::all();
        //dd($loans);

        return view('admin.staff.operations.viewStaffLoan',compact(['repaymentTypes','loanTypes','loans']));

    }


    public function viewCreateStaffLoan(Request $request){
        // dd('shs');
        $branches = \App\Office::whereIn('level', [6,7,8])->get(); //dd($branches);
        $repaymentTypes = \App\RepaymentType::all();
        $loanTypes = \App\LoanType::all();

        if(isset($request->submit)){


        }
        return view("admin.staff.operations.createStaffLoan",compact(['branches', 'repaymentTypes', 'loanTypes']));
    }

    public function postCreateStaffLoans(Request $request){
        $message = "created";

        // dd($request);
        $loan = new \App\LoanOpration([
            "branch_id"=>$request->branch_id,
            "staff_id"=>$request->staff_id,
            "repaymentId"=>$request->repaymentId,
            "loanTypeId"=>$request->loanTypeId,
            "comment"=>$request->comment,
            "amount"=>$request->amount,
            "issuer_id"=>Auth::user()->id,

        ]);
        // dd($loan);
        $loan->save();
        $loans = \App\LoanOpration::join('offices','offices.id','loanoprations.branch_id')
            ->join('users','users.id','loanoprations.staff_id')
            ->select('users.*','offices.name as officename','loanoprations.comment','loanoprations.status')
            ->get();
        return redirect()->back()->with("message",'Loan Created Successfully');
    }

    
    public function viewCreateIncidence(Request $request){
        $offences = \App\Offence::all();//dd($offences);
        $user_id = $request->user_id;//dd($request);

        $users = \App\User::where('id',$user_id)->first();
        $offenceRaised = \App\IncidenceOpration::join('offices','offices.id','incidenceoprations.branch_id')
            ->join('offences','offences.id','incidenceoprations.offence_id')
            ->join('users','users.id','incidenceoprations.staff_id')
            ->where('incidenceoprations.staff_id',$user_id)
            ->select('users.*','offices.name as officename','offences.name as offencename','offences.amount','incidenceoprations.comment','incidenceoprations.created_at as date','incidenceoprations.status as offenceStatus')
            ->get();
        if(isset($request->submit) && $request->submit == 'createOffence'){
            $message = "created";
            $user_id = $request->user_id;
            $offences = new \App\IncidenceOpration([
                "branch_id"=>$users->branchId,
                "offence_id"=>$request->offence_id,
                "staff_id"=>$user_id,
                "comment"=>$request->comment,
                "issuer_id"=>Auth::user()->id,
            ]);
            $offences->save();

            alert()->success("Created Successfully", 'Success');
            return redirect()->back()->with("message",'Offence Created Successfully');
        }
        return view('admin.staff.operations.viewIncidence',compact(['offences','offenceRaised','user_id']));

    }
    

    public function viewCreateBonus(Request $request){
        $bonuses = \App\Bonus::all();//dd($offences);
        $user_id = $request->user_id;//dd($request);
        $users = \App\User::where('id',$user_id)->first();
        $bonusOperation = \App\BonusOpration::join('offices','offices.id','bonusoprations.branch_id')
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

            alert()->success("Bonus Created Successfully", 'Success');
            return redirect()->back()->with("message",'Bonus Created Successfully');
            //return view('admin.staff.operations.viewBonus',compact(['bonuses','message','user_id']));

        }
        return view('admin.staff.operations.viewBonus',compact(['bonuses','bonusOperation','user_id']));

    }



    public function viewCreateSuspension(Request $request){
        $user_id = $request->user_id;//dd($request);
        $users = \App\User::where('id',$user_id)->first();
        $suspensions = \App\SuspensionOpration::join('offices','offices.id','suspensionoprations.branch_id')
            ->join('users','users.id','suspensionoprations.staff_id')
            ->where('suspensionoprations.staff_id',$user_id)
            ->select('users.*','offices.name as officename','suspensionoprations.comment','suspensionoprations.startDate','suspensionoprations.endDate','suspensionoprations.status')
            ->get();
        //dd($suspensions);
        if(isset($request->submit) && $request->submit == 'createSuspension'){
            $message = "created";
            $user_id = $request->user_id;
            //dd($request);
            $suspension = new \App\SuspensionOpration([
                "branch_id"=>$users->branchId,
                "startDate"=>$request->startDate,
                "endDate"=>$request->endDate,
                "staff_id"=>$user_id,
                "comment"=>$request->comment,
                "issuer_id"=>Auth::user()->id,

            ]);
            $suspension->save();
            //dd($request);
            $suspensions = \App\SuspensionOpration::join('offices','offices.id','suspensionoprations.branch_id')
                //->join('departments','departments.id','')
                ->join('users','users.id','suspensionoprations.staff_id')
                ->where('suspensionoprations.staff_id',$user_id)
                ->select('users.*','offices.name as officename','suspensionoprations.comment','suspensionoprations.startDate','suspensionoprations.endDate','suspensionoprations.status')
                ->get();

            alert()->success("Suspension Created Successfully", 'Success');
            return redirect()->back()->with("message",'Suspension Created Successfully');
            //return view('admin.staff.operations.viewSuspension',compact(['message','suspensions','user_id']));

        }
        return view('admin.staff.operations.viewSuspension',compact(['user_id','suspensions']));

    }


    public function viewAllowance()
    {
        $allowances = \App\AllowanceOpration::join('offices','offices.id','allowanceoprations.branch_id')
            ->join('users','users.id','allowanceoprations.staff_id')
            //->where('allowanceoprations.staff_id',$user_id)
            ->select('users.*','offices.name as officename', 'allowanceoprations.amount', 'allowanceoprations.created_at','allowanceoprations.comment','allowanceoprations.status')
            ->get();
        return view('admin.staff.operations.viewAllowance',compact(['allowances']));
    }


    public function viewCreateAllowance()
    {
        $branches = \App\Office::whereIn('level', [6,7,8])->get();
        $allowanceList = \App\Allowance::all();
        return view('admin.staff.operations.createAllowance',compact(['branches', 'allowanceList']));
    }


    public function storeAllowance(Request $request)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required',
            'amount' => 'required',
            'allowance_id' => 'required',
            'comment' => 'required',
        ]);
        $user = Auth::user()->id;
        $staff = \App\User::where('id', $request->staff_id)->first();

        $allowance = new \App\AllowanceOpration([
            "amount" => $request->amount,
            "branch_id"=>$staff->branchId,
            "allowance_id"=>$request->allowance_id,
            "staff_id"=>$staff->id,
            "comment"=>$request->comment,
            "issuer_id"=>Auth::user()->id,
        ]);
        $allowance->save();
        alert()->success('Allowance Created Successfully', '');
        return redirect()->back()->with("message",'Allowance Created Successfully');
    }


    /*
    public function viewCreateAdvance(Request $request){
        //$user_id = Auth::user()->id;//dd($request);
	 $user_id = $request->user_id;//dd($request);
	//dd($request->user_id);
        $users = \App\User::where('id',$user_id)->first();
        $advances = \App\AdvanceOpration::join('offices','offices.id','advanceoperations.branch_id')
            ->join('users','users.id','advanceoperations.staff_id')
            ->where('advanceoperations.staff_id',$user_id)
            ->select('users.*','offices.name as officename','advanceoperations.amount','advanceoperations.comment','advanceoperations.created_at','advanceoperations.startDate','advanceoperations.endDate','advanceoperations.status as datastatus')
            ->get();
	//dd($request);
	//var_dump($users);die();
        if(isset($request->submit) && $request->submit == 'createAdvance'){
            $message = "created";

            // dd($request);
            $advance = new \App\AdvanceOpration([
                "branch_id"=>$users->branchId,
                "startDate"=>$request->startDate,
                "endDate"=>$request->endDate,
                "staff_id"=>$user_id,
                "comment"=>$request->comment,
                "issuer_id"=>Auth::user()->id,
                "amount"=>$request->amount,

            ]);
            $advance->save();
            $advances = \App\AdvanceOpration::join('offices','offices.id','advanceoperations.branch_id')
                ->join('users','users.id','advanceoperations.staff_id')
                ->where('advanceoperations.staff_id',$user_id)
                ->select('users.*','offices.name as officename','advanceoperations.comment','advanceoperations.startDate','advanceoperations.endDate','advanceoperations.status')
                ->get();
            return redirect()->back()->with("message",'Advance Created Successfully');

        }
        // dd($advances);
        return view('admin.staff.operations.viewAdvance',compact(['user_id','advances','users']));

    }
   

    public function viewCreateAllowance(Request $request){
	
	//$user_id = Auth::user()->id;    
	$user_id = $request->user_id;//dd($request);
        $users = \App\User::where('id',$user_id)->first();
        $allowanceList = \App\Allowance::all();
        $allowances = \App\AllowanceOpration::join('offices','offices.id','allowanceoprations.branch_id')
            ->join('users','users.id','allowanceoprations.staff_id')
            ->where('allowanceoprations.staff_id',$user_id)
            ->select('users.*','offices.name as officename', 'allowanceoprations.amount', 'allowanceoprations.created_at','allowanceoprations.comment','allowanceoprations.status')
            ->get();
        //dd($allowances);
        if(isset($request->submit) && $request->submit == 'createAllowance'){
            $message = "created";
	    //dd($request);
            // dd($request->amount);


            $allowance = new \App\AllowanceOpration([
                "amount" => $request->amount,
                "branch_id"=>$users->branchId,
                "allowance_id"=>$request->allowance_id,
                "staff_id"=>$user_id,
                "comment"=>$request->comment,
                "issuer_id"=>Auth::user()->id,

            ]);
            $allowance->save();
            $allowances = \App\AllowanceOpration::join('offices','offices.id','allowanceoprations.branch_id')
                ->join('users','users.id','allowanceoprations.staff_id')
                ->where('allowanceoprations.staff_id',$user_id)
                ->select('users.*','offices.name as officename', 'allowanceoprations.comment','allowanceoprations.status')
                ->get();
            return redirect()->back()->with("message",'Allowance Created Successfully');
        }
        // dd($allowances);
        return view('admin.staff.operations.viewAllowance',compact(['user_id','allowances','allowanceList','users']));

    }
   */

    public function viewCreateDeduction(Request $request){
        //$user_id = $request->user_id;//dd($request);
        $users = \App\User::where('id',Auth::user()->id)->first();
        $deductions = \App\DeductionOpration::join('offices','offices.id','deductionoprations.branch_id')
            ->join('users','users.id','deductionoprations.staff_id')
            ->join('deduction','deduction.id','deductionoprations.deduction_id')
            ->where('deductionoprations.staff_id',Auth::user()->id)
            ->select('users.*','offices.name as officename','deductionoprations.created_at as date','deduction.deduction','deductionoprations.comment','deductionoprations.status')
            ->get();

        $deductionList = \App\Deduction::all();
        //dd($suspensions);
        if(isset($request->submit) && $request->submit == 'createDeduction'){
            $message = "created";

            //dd($request);
            $deduction = new \App\DeductionOpration([
                "branch_id"=>$users->branchId,
                "staff_id"=>$request->user_id,
                "deduction_id"=>$request->deduction_id,
                "comment"=>$request->comment,
                "issuer_id"=>Auth::user()->id,

            ]);
            $deduction->save();
            $deductions = \App\DeductionOpration::join('offices','offices.id','deductionoprations.branch_id')
                ->join('users','users.id','deductionoprations.staff_id')
                ->where('deductionoprations.staff_id',Auth::user()->id)
                ->select('users.*','offices.name as officename','deductionoprations.comment','deductionoprations.status')
                ->get();
            return redirect()->back()->with("message",'Dedction Created Successfully');

        }
        return view('admin.staff.operations.viewDeduction',compact(['user_id','deductions','deductionList']));

    }




    public function viewCreateLoan(Request $request){
        $user_id = $request->user_id;//dd($request);
        $users = \App\User::where('id',$user_id)->first();
	$repaymentTypes = \App\RepaymentType::all();
	$loans = \App\LoanOpration::join('offices','offices.id','loanoprations.branch_id')
	//	->join('loantypes','loantypes.loanName','loanoprations.loanTypeId')
                ->join('users','users.id','loanoprations.staff_id')
              //  ->join('loantypes','loantypes.loanName','loanoprations.loanTypeId')
                ->where('loanoprations.staff_id',$user_id)
                ->select('users.*','offices.name as officename', 'loanoprations.amount','loanoprations.comment','loanoprations.loanTypeId','loanoprations.repaymentId', 'loanoprations.created_at','loanoprations.status')
		->get();
//	dd($loans);
        $loanTypes = \App\LoanType::all();
  //      dd($loanTypes);
        if(isset($request->submit) && $request->submit == 'createLoan'){
            $message = "created";
		//var_dump($request->amount);die();
            //dd($request);
            $loan = new \App\LoanOpration([
                "branch_id"=>$users->branchId,
                "staff_id"=>$request->user_id,
                "repaymentId"=>$request->repaymentId,
                "loanTypeId"=>$request->loanTypeId,
                "comment"=>$request->comment,
		"issuer_id"=>Auth::user()->id,
		"amount"=>$request->amount,

            ]);
            $loan->save();
            $loans = \App\LoanOpration::join('offices','offices.id','loanoprations.branch_id')
		->join('users','users.id','loanoprations.staff_id')
		->join('loantypes','loantypes.loanName','loanoprations.loanTypeId')
                ->where('loanoprations.staff_id',$user_id)
                ->select('users.*','offices.name as officename','loantypes.loanName as loan_name', 'loanoprations.amount','loanoprations.comment','loanoprations.loanTypeId','loanoprations.repaymentId', 'loanoprations.created_at','loanoprations.status')
		->get();
	   // dd($loans);
            return redirect()->back()->with("message",'Dedction Created Successfully');

	}
//	dd($loans);
	//var_dump($loanTypes);die();
        return view('admin.staff.operations.viewLoan',compact(['user_id', 'users', 'repaymentTypes','loanTypes','loans']));

    }






    public function getAllOffice(){
        $offices = new Offices();
        $getOffice = $offices->GetAllOffice();
        return view('admin.viewOffices')->with("offices",$getOffice);
    }


    public function viewStaffTable(){
        $staff = \App\User::all();
        return view('admin.staff.viewStaffTable',compact('staff'));

    }

    public function viewStaffProfile(Request $request){
        $user_id = $request->user_id;
        $staff = \App\User::find($user_id);
        $workExperience = \App\WorkExperience::where('userId',$user_id)->first();
        //dd($staff);
        $staffBankAcc = \App\StaffBankAcc::where('userId',$user_id)->first();

        $emmergencyContact = \App\EmergencyContact::where('userId',$user_id)->first();

        $guarantor = \App\Guarantor::where('userId',$user_id)->first();

        $requiredData = [
            "staff_id" => $user_id,
            "level_id" => $staff->level
        ];

        $staffController = new StaffController();
        $requiredDocuments = $staffController->getRequiredDocument($requiredData);

        $requiredDocuments = $requiredDocuments->original;

        $nextOfKin = \App\NextOfKin::where('userId',$user_id)->first();//dd('here');
        return view('admin.staff.staffProfile', compact(['staff','workExperience','staffBankAcc','emmergencyContact','guarantor','nextOfKin','requiredDocuments']));
    }

}
