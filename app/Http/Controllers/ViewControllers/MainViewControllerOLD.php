<?php

namespace App\Http\Controllers\ViewControllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Offices;
use Illuminate\Http\Request;
//use ('../Core/Offices.php');
use App\Http\Controllers\Core\CreateStaffClass;

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
	//dd($createStatus);
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
    

        public function createStaffOne(Request $request){

        if($request->session()->has('personalInfo')){
            
            $personalInfo = $request->session()->get('personalInfo');

        }else{
            
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
		//dd('here');
            $personalInfo = $request->session()->put('personalInfo', $validatedData);
	    
        }

        return view('admin.staff.createCompanyInfo');  

    } 

    public function createStaffCompanyInfo(Request $request){

        if($request->session()->has('companyInfo')){

            $personalInfo = $request->session()->get('companyInfo');

        }else{

            $validatedData = $request->validate([
                'state' => 'required',
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
                //dd('here');
            $companyInfo = $request->session()->put('companyInfo', $validatedData);
            
        }

        return view('admin.staff.createEduAndWorkExperience');  
    
    }  

	
    function createWorkAndEduction(Request $request){
		//dd($request->session()->all());
            /*if($request->session()->has('workEducation')){
    
                $personalInfo = $request->session()->get('workEducation');
   		//dd($personalInfo);
            }else{*/
    
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

                    //'terminationDate' => 'required',
                    //'staffLevel' => 'required',
                    //'resumptionType' => 'required',
                ]);
                    //dd('here');
                $companyInfo = $request->session()->put('workEducation', $validatedData);
   		$data = $request->session()->all();//dd($data);
		$createEmp = new CreateStaffClass();
    		$response = $createEmp->creatStaff($request,$data);
		//dd($response);
 //           }
    
            //return view('admin.staff.createFileUpload');
    
        }


}
