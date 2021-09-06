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


class MainViewController extends Controller
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


    public function createOfficeRequest(Request $request){
	
        //dd($request);
        $name = $request->name;
        $emailAddress = $request->email;
        $phone = $request->phone;
        $location = $request->location;
        $managerId = "";
        $type=$request->officeType;
        $level =$request->officeLevel;
        $city ="city";//$request->city;
        $state =$request->state;
        $country =$request->country;
        $parentOfficeId =$request->officeLevel;


        $req = new Request([
            "name" => $name,
            "emailAddress" => $emailAddress,
            "phone" => $phone,
            "location" => $location,
            "managerId" => "",
            "type"=>$type,
            "level" =>$level,
            "city" =>$city,
            "state" =>$state,
            "country" =>$country,
            "parentOfficeId" =>$parentOfficeId,
        ]);
        $offices = new Offices();	
        $createStatus = $offices->CreateOffice($req);
        
        if($createStatus == 1){
            return redirect()->back()->with("status","Office Created Successfully");
        }
        elseif($createStatus){
        return redirect()->back()->with("status",$createStatus );
        
        }
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
	    //dd($user_id);
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
dd($requiredDocuments);
/*	$requiredDocuments = [
		"status" => "300",
		"message" => "Under going test",
		"data" => ["CAT", "FISH", "SNAIL"]
	];
*/
        $nextOfKin = \App\NextOfKin::where('userId',$user_id)->first();//dd('here');
        return view('admin.staff.staffProfile', compact(['staff','workExperience','staffBankAcc','emmergencyContact','guarantor','nextOfKin','requiredDocuments']));
    }



    public function createStaffOne(Request $request){

        if(isset($request->proceed)){
            $validatedData = $request->validate([
                'firstName' => 'required',
                'middleName' => 'required',
                'lastName' => 'required',
                'residentialAddress' => 'required',
                'homeAddress' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'state' => 'required',
                'lga' => 'required',
                'dob'=>'required',
		        'imgUrl' =>'',
                'gender' => 'required',
                'maritalStatus' => 'required',
                'nextofkinName' => 'required',
                'nextofkinRelationship' => 'required',
                'nextofkinPhone' => 'required',
                'nextofkinAddress' => 'required',
                'nextofkinContact' => 'required',
                'emmergencyPhone' => 'required',
                'emergencyAddress' => 'required',
            ]);

		//dd($request);
	    //handle Staff Image
           /*if(isset($request->staff_pic))
           {     
                 $fileNameWithExt=$request->file('staff_pic')->getClientOriginalName();
                 //Get Extension
                 $fileExt=$request->file('staff_pic')->getClientOriginalExtension();
                 //new dynamic name
                 $fileNameToStore=strtolower($request->first_name."_".$request->last_name."_".rand(1,9999999).".".$fileExt);
                 //upload image
                 $path=$request->file('staff_pic')->storeAs('public/staff_pics',$fileNameToStore);
            
           }
           else{
            $fileNameToStore='no_pic.jpg';//or whatever
	   }dd($fileNameToStore);*/
            $personalInfo = $request->session()->put('personalInfo', $validatedData);
	    $departments = \App\Department::all();
	    $banks = \App\Bank::all();
	    $units = \App\Unit::all();
	    $levels = \App\Level::all();
	    $resumptionTypes = \App\ResumptionType::all();
	    $offices = \App\Office::all();
	    if($request->session()->has('companyInfo')){
		$companyInfo = $request->session()->get('companyInfo');	
	        $ex= explode("|",$companyInfo['bank']);	
		$selectedBank =$ex[1]; //dd($selectedBank);	
	    }

            return view('admin.staff.createCompanyInfo', compact(['personalInfo','offices','selectedBank','resumptionTypes','levels','units','banks','departments']));  
        }        
    } 

    public function createStaffCompanyInfo(Request $request){        
        //dd($request);
        if(isset($request->back) && $request->back == "Back"){
            if($request->session()->has('personalInfo')){            

                $personalInfo = $request->session()->get('personalInfo');
    
                return view('admin.staff.newStaff', compact('personalInfo')); 
            }
        }

        else if(isset($request->proceed) && $request->proceed == "Proceed"){
            $validatedData = $request->validate([
                'status' => 'required',
                'staffBranch' => 'required',
                'bank' => 'required',
                'accountName' => 'required',
                'accountNumber' => 'required',
                'gender' => 'required',
                'staffUnit' => 'required',
                'staffDepartment' => 'required',
                'staffDepartmentRole' => 'required',
                'g_name' => 'required',
                'g_phone'=>'required',
                'g_email'=>'required',
                'g_office_address'=>'required',
                'g_home_address'=>'required',
                'resumptionDate' => 'required',
                'assumptionDate' => 'required',
                'terminationDate' => 'required',
                'staffLevel' => 'required',
                'resumptionType' => 'required',
            ]);

            $companyInfo = $request->session()->put('companyInfo', $validatedData);
            $education_qual_collection= \App\Qualification::all();
            $education_type_collection = \App\EducationType::all();
            $education_class_collection = \App\EducationClass::all();
	    //$department = \App\Department::all();
            return view('admin.staff.createEduAndWorkExperience',compact(["education_qual_collection","education_type_collection","education_class_collection"]));  

        }        
    }  

	
    function createWorkAndEduction(Request $request){
		
        if(isset($request->back)){
            if($request->session()->has('companyInfo')){
		
                $companyInfo = $request->session()->get('companyInfo');
    		$departments = \App\Department::all();
                $banks = \App\Bank::all();
                $units = \App\Unit::all();
                $levels = \App\Level::all();
                $resumptionTypes = \App\ResumptionType::all();
		$offices = \App\Office::all();
                return view('admin.staff.createCompanyInfo', compact('companyInfo','offices','resumptionTypes','levels','units','banks','departments'));  
    
            }
        }

        if(isset($request->proceed)){
	//dd($request);
            $validatedData = $request->validate([
                'establishment_name' => 'required',
                'work_start_year' => 'required',
                'work_end_year' => 'required',
                'position_held' => 'required',
                'job_functions' => 'required',
                'education_type_id' => 'required',
                'start_year' => 'required',
                'end_year' => 'required',
                'institution_name' => 'required',
                'course_name' => 'required',
                'education_qual_id' => 'required',
                'education_class_id' => 'required',
            ]);
                        
            $companyInfo = $request->session()->put('workEducation', $validatedData);
            $data = $request->session()->all();//dd($data);
	    return view('admin.staff.preview');
            //$createEmp = new CreateStaffClass();
            //$response = $createEmp->creatStaff($request,$data);		
        }
    }


   function submitStaffForm(Request $request){

	if(isset($request->back) && $request->back == "Back"){
            if($request->session()->has('companyInfo')){

                $companyInfo = $request->session()->get('companyInfo');

                return view('admin.staff.createCompanyInfo', compact("companyInfo"));

            }
        }else{

	


	$data = $request->session()->all();
	$createEmp = new CreateStaffClass();
	$response = $createEmp->creatStaff($request,$data);
	//dd($response);
	$response = json_decode($response->getContent());//dd($response->message);
        $message = $response->message;
	if($response->status == "200"){
		$request->session()->flush();
	  return view('admin.staff.newStaff',compact('message'));//->with('message', $response->message);	
	}else{
	 $request->session()->flush();	
	  return view('admin.staff.newStaff',compact('message'));
	}	
      }
   }


   //crud for Level Starts
   public function createLevel(Request $request){

        if(isset($request->submit) && $request->submit == "createLevel"){
            $requiredDoc = "";
            $count = sizeof($request->selectedDoc);
            
            foreach($request->selectedDoc as $selected){
                $requiredDoc = $selected->id.",".$requiredDoc ;
            }

            $create = new \App\Level([

                "title"=>$request->name,
                "required_doc_ids"=>$requiredDoc,
                "salary"=> $request->salary,
            ]);
            if($create->save()){

                // return response()->json([
                //     "status"=> "200",
                //     "message"=>"Saved Successfully"
                // ]);

                return redirect()->with("success","Level Created Successfully");
            }
            
            
        }else{

            $documents = \App\Document_table::all();

            return view('admin.staff.level.createLevel',compact('documents'));
        }
    }
}



