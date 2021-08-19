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
                    return redirect()->back()->with('message','Cancelled Successfully');
                }
            }
            if(isset($request->submit) && $request->submit == "approve"){
                
                $update = \App\Attendance::where('staff_number',$request->staff_number)->update(['status'=>1]);
                if($update){
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
       
      $leaveData = \App\LeaveRequest::join('offcategories','offcategories.id','leaverequests.leavecategory_id')
            ->join('offtypes','offtypes.id', 'leaverequests.leavetype_id')
            ->join('users','users.id','leaverequests.staff_id')
            ->select('leaverequests.*','leaverequests.dates as day','users.firstname','offcategories.category','offtypes.type')

            ->where('leaverequests.staff_id',Auth::user()->id)->get();
        return view('admin.staff.operations.leaveRequest',compact('leaveData'));
    }



   public function returnCreateLeave(Request $request){
        
	//dd($request);
        $leavetype = \App\OffType::all();
        $leavecategory = \App\OffCategory::all();
        $user_id = $request->user_id;

        if(isset($request->submit)){
          //dd("herere") ; 

            $dates = $request->dates;
            $exp = explode(",",$dates);
            $count = sizeof($exp);
            for($i = 0; $i<$count;$i++){
                
                $offences = new \App\LeaveRequest([
                    "staff_id"=>Auth::user()->id,
                    "leavecategory_id"=>$request->leavecategory_id,
                    "leavetype_id"=>$request->leavetype_id,
                    "comment"=>$request->comment,
                    "dates"=>$exp[$i],
                ]);
                $offences->save();

            }
            
            
            return redirect()->back()->with("message",'Request has been submitted Created Successfully');
        }
         return view('admin.staff.operations.requestLeave',compact(['leavetype','leavecategory','user_id']));
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
			//dd($suspensions);
			return redirect()->back()->with("message",'Suspension Created Successfully');
                //return view('admin.staff.operations.viewSuspension',compact(['message','suspensions','user_id']));

        } 
        return view('admin.staff.operations.viewSuspension',compact(['user_id','suspensions']));
          
   }  
    
   

   public function viewCreateAdvance(Request $request){
    $user_id = Auth::user()->id;//dd($request);
    $users = \App\User::where('id',Auth::user()->id)->first();
    $advances = \App\AdvanceOpration::join('offices','offices.id','advanceoperations.branch_id')
        ->join('users','users.id','advanceoperations.staff_id')	
        ->where('advanceoperations.staff_id',Auth::user()->id)
        ->select('users.*','offices.name as officename','advanceoperations.amount','advanceoperations.comment','advanceoperations.created_at','advanceoperations.startDate','advanceoperations.endDate','advanceoperations.status as datastatus')
        ->get();
        //dd($request);
    if(isset($request->submit) && $request->submit == 'createAdvance'){
        $message = "created";
        
    //dd($request);
        $advance = new \App\AdvanceOpration([
        "branch_id"=>$users->branchId,
        "startDate"=>$request->startDate,
        "endDate"=>$request->endDate,
        "staff_id"=>Auth::user()->id,
        "comment"=>$request->comment,
        "issuer_id"=>Auth::user()->id,
	"amount"=>$request->amount,

    ]);
    $advance->save();
    $advances = \App\AdvanceOpration::join('offices','offices.id','advanceoperations.branch_id')
        ->join('users','users.id','advanceoperations.staff_id')
        ->where('advanceoperations.staff_id',Auth::user()->id)
        ->select('users.*','offices.name as officename','advanceoperations.comment','advanceoperations.startDate','advanceoperations.endDate','advanceoperations.status')
        ->get();
        return redirect()->back()->with("message",'Advance Created Successfully');

    }//dd($advances); 
    return view('admin.staff.operations.viewAdvance',compact(['user_id','advances']));
      
}  


public function viewCreateAllowance(Request $request){
    //$user_id = $request->user_id;//dd($request);
    $users = \App\User::where('id',Auth::user()->id)->first();
    $user_id = Auth::user()->id;
    $allowanceList = \App\Allowance::all();
    $allowances = \App\AllowanceOpration::join('offices','offices.id','allowanceoprations.branch_id')
        ->join('users','users.id','allowanceoprations.staff_id')	
        ->where('allowanceoprations.staff_id',Auth::user()->id)
        ->select('users.*','offices.name as officename','allowanceoprations.created_at','allowanceoprations.comment','allowanceoprations.status')
        ->get();
        //dd($allowances);
    if(isset($request->submit) && $request->submit == 'createAllowance'){
        $message = "created";
        
    //dd($request);


        $allowance = new \App\AllowanceOpration([
        "branch_id"=>$users->branchId,
        "allowance_id"=>$request->allowance_id,
        "staff_id"=>Auth::user()->id,
        "comment"=>$request->comment,
        "issuer_id"=>Auth::user()->id,

    ]);
    $allowance->save();
    $allowances = \App\AllowanceOpration::join('offices','offices.id','allowanceoprations.branch_id')
        ->join('users','users.id','allowanceoprations.staff_id')
        ->where('allowanceoprations.staff_id',Auth::user()->id)
        ->select('users.*','offices.name as officename','allowanceoprations.comment','allowanceoprations.status')
        ->get();
        return redirect()->back()->with("message",'Allowance Created Successfully');

    } 
    return view('admin.staff.operations.viewAllowance',compact(['user_id','allowances','allowanceList']));
      
}  


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
    //$user_id = $request->user_id;//dd($request);
    $users = \App\User::where('id',Auth::user()->id)->first();
    $loans = \App\LoanOpration::join('offices','offices.id','loanoprations.branch_id')
        ->join('users','users.id','loanoprations.staff_id')	
        ->where('loanoprations.staff_id',Auth::user()->id)
        ->select('users.*','offices.name as officename','loanoprations.comment','loanoprations.status')
        ->get();
	$repaymentTypes = \App\RepaymentType::all();
	$loanTypes = \App\LoanType::all();
        //dd($loanTypes);
    if(isset($request->submit) && $request->submit == 'createLoan'){
        $message = "created";
        
    //dd($request);
        $loan = new \App\LoanOpration([
        "branch_id"=>$users->branchId,
        "staff_id"=>$request->user_id,
        "repaymentId"=>$request->repaymentId,
        "loanTypeId"=>$request->loanTypeId,
        "comment"=>$request->comment,
        "issuer_id"=>Auth::user()->id,

    ]);
    $loan->save();
    $loans = \App\LoanOpration::join('offices','offices.id','loanoprations.branch_id')
        ->join('users','users.id','loanoprations.staff_id')
        ->where('loanoprations.staff_id',Auth::user()->id)
        ->select('users.*','offices.name as officename','loanoprations.comment','loanoprations.status')
        ->get();
        return redirect()->back()->with("message",'Dedction Created Successfully');

    } 
    return view('admin.staff.operations.viewLoan',compact(['user_id','repaymentTypes','loanTypes','loans']));
      
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






