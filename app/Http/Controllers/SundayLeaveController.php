<?php

namespace App\Http\Controllers;

use App\Department;
use App\IncidenceOpration;
use App\Office;
use App\OfficeStock;
use App\Reason;
use App\Asset;
use App\GameService;
use App\User;
use App\Branch;
use App\SundayLeave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class SundayLeaveController extends Controller
{
        public function __construct()
        {
            $this->middleware('auth');
        }

          
        
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

public  function sundayLeave(Request $request){

    //        //method to query the database 

    $offices = \App\User::all();

    $getBranch = Office::where('type', 'like', 'BRANCH%')->get();

    $sundayleave = DB::table('branchs');
    

            $myStatus = $request->input('status');
            $myStaffNumber = $request->input('staff_number');
            $myMaritalStatus = $request->input('maritalstatus');
            $myResumptionYear = $request->input('resumptionDate');
            $myDepartment= $request->input('department');
            $myResumptionType = $request->input('resumptionType');
            $myGender = $request->input('gender');
            $myLga = $request->input('lga');
            $myEmail = $request->input('email');
            $myFirstName = $request->input('firstname');
            $myLevel = $request->input('level');
            $myBranch = $request->input('branchtype');
            $myUnit = $request->input('unit');
            $myPhone = $request->input('phone');
            $myLastName = $request->input('lastname');
            $myState  = $request->input('state');
            $myRole = $request->input('role_id');
            $myDob  = $request->input('dob');
            
            Log::info($request);
            Log::info($myFirstName);
 
            $sundayleave = DB::table('users')
            
            
                                   ->when($myStatus, function ($query, $myStatus) {
                                    $query->where('status','LIKE', "%{$myStatus}%" );
                                    
                                })
                                ->when($myStaffNumber, function ($query, $myStaffNumber) {
                                    $query->where('staff_number','LIKE', "%{$myStaffNumber}%" );
                                    
                                })
                             
                                ->when($myResumptionYear, function ($query, $myResumptionYear) {
                                    $query->where('resumptionDate','LIKE', "%{$myResumptionYear}%" );
                                    
                                })
                          
                                ->when($myLga , function ($query,$myLga  ) {
                                    $query->where('lga','LIKE', "%{$myLga}%" );
                                    
                                })
                                ->when($myEmail , function ($query,$myEmail) {
                                    $query->where('email','LIKE', "%{$myEmail}%" );
                                
                                })
                                ->when($myFirstName, function ($query, $myFirstName) {
                                    $query->where('firstname','LIKE', "%{$myFirstName}%" );
                                })
                                ->when($myLevel, function ($query,$myLevel) {
                                    $query->where('level','LIKE', "%{$myLevel}%" );
                                   
                                })
                                ->when($myBranch, function ($query,$myBranch  ) {
                                    $query->where('branchtype','LIKE', "%{$myBranch}%" );
                                   
                                })
                             
                                ->when($myPhone, function ($query, $myPhone ) {
                                    $query->where('phone','LIKE', "%{$myPhone}%" );
                                    
                                })
                                ->when($myLastName, function ($query,$myLastName) {
                                    $query->where('lastname','LIKE', "%{$myLastName}%" );
                                    
                                })
                                ->when($myState, function ($query,$myState) {
                                    $query->where('state','LIKE', "%{$myState}%" );
                                    
                                })
                                ->when($myRole, function ($query,$myRole) {
                                    $query->where('role_id','LIKE', "%{$myRole}%" );
                                  
                                })
                                ->when($myDob, function ($query,$myDob) {
                                    $query->where('dob','LIKE', "%{$myDob}%" );
                                    // $query->where('dob',$myDob);
                                })
                                ->get();
                            //   dd($sundayleave);

        //     if ($staff){
        //         return view('admin.staff.viewStaffTable',compact('staff'));
        //     }else
        //    return redirect()->back()->with('message','data not  found');
      
                    return view('admin.staff.view-sundayleave',compact('sundayleave' ,'offices', 'getBranch'));
        //return $request->all();
    
    }
    public function index()
    {

        $sundayleave = Sundayleave::all();
        return view('admin.view-sundayleave',compact('sundayleave'));
    }
    

    public function createSundayleave()
    {
        $banks = \App\Bank::all();
      
        $getBranch = Office::where('type', 'like', 'BRANCH%')->get();

                return view('admin.staff.create-sundayleave',compact('getBranch','banks'));          //
    }
    

    public function storeSundayleave(){
        $validator = Validator::make($request->all(),[
            'staff name' =>'required',
            'branch' =>'required',
            'status' =>'required',
            'phone' =>'required',
            'resumption date' =>'required',
        ]);
        $sundayleave = new Sundayleave();

        $sundayleave->staffname= $request->staffname;
        $sundayleave->branch = $request->branch;
        $sundayleave->status = $request->status;
        $sundayleave->phone= $request->phone;
        $sundayleave->resumptiondate = $request->resumptiondate;
        
    
        $sundayleave->save();

        return redirect('view-sundayleave')->with('status','sundayleave data successfully inserted');

    }

    public function deleteSundayleave(Request $request)
    {
    
        $id = $request->id;
        // dd($id);
        $sundayleave  = Sundayleave::find($id);
        $sundayleave->delete();
        return redirect()->back()->with('status','sundayleave data succesfully deleted');
    }

    public function sumbitSundayleave(Request $request)
    {

        // dd($request);
        $validator = Validator::make($request->all(),[
          
            'pso' =>'required',
        ]);


        foreach ($request->pso as $id ) {
            $single_user = User::where("id",$id)->first();
            $single_user->permanentsunday_approval= '1';
            // dd($single_user);
            $single_user->save();
        }


        return redirect('view-sundayleave')->with('status','sundayleave data successfully sumbited');

    }

}