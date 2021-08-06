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




    public function officeInfo(Request $request){ 
    
        $office = \App\Office::where('id',$request->id)->first();

        return view('admin.offices.officeInfo',compact('office'));
    }

    public function updateOffice(Request $request){
        $updateOffice = \App\Office::where('id',$request->id)->update(["name"=>$request->name,"emailAddress"=>$request->emailAddress,"phone"=>$request->phone,"location"=>$request->address]);
        if($updateOffice){
            return redirect()->back()->with("message","Office info Updated Successfully");
        }else{
            return redirect()->back()->with("message","Office info could not be updated Successfully");
        }
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
//dd($requiredDocuments);
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
           //dd($request); 
            foreach($request->selectedDoc as $selected){
                $requiredDoc = $selected.",".$requiredDoc ;
            }
		$requiredD = rtrim($requiredDoc, ",");
		$check = \App\Level::where("title",$request->name)->exists();
		if($check){
		 $documents = \App\Document_table::all();
		 return redirect()->back()->with("message","Level Already Exists",compact('documents'));
		}

		//dd($requiredD);
            $create = new \App\Level([

                "title"=>$request->name,
                "required_doc_ids"=>$requiredD,
                "salary"=> $request->salary,
            ]);
            if($create->save()){

                // return response()->json([
                //     "status"=> "200",
                //     "message"=>"Saved Successfully"
                // ]);
		$documents = \App\Document_table::all();
                return redirect()->back()->with("message","Level Creted Successfully",compact('documents'));
            }
            
            
        }else{

            $documents = \App\Document_table::all();

            return view('admin.staff.data.createLevel',compact('documents'));
        }
    }


    public function viewLevel(Request $request){

        $levels = \App\Level::all();
        
        return view('admin.staff.data.viewLevel',compact('levels'));
        
    }


    public function updateLevel(Request $request){
	//dd($request);
	 $levelDetails = \App\Level::where('id',$request->id)->first();
	if(isset($request->submit) && $request->submit == "edit"){
	//	dd($request->id);
            //$levelDetails = \App\Level::where('id',$request->id)->first();
            
            $required_doc = [];
            $strr = explode(",",$levelDetails->required_doc_ids);
            //dd($strr);
            $count = sizeof($strr);
            for($i = 0; $i<$count;$i++){
                array_push($required_doc, $strr[$i]);
            }

            $allDoc = \App\Document_table::all();
            
            $documents = [];
            foreach($allDoc as $doc){

                if(in_array($doc->id,$required_doc)){
                    $renderDoc = ["id"=>$doc->id, "name"=>$doc->name,"type"=>"checked"];
                    array_push($documents, $renderDoc);
                }else{
                    $renderDoc = ["id"=>$doc->id, "name"=>$doc->name,"type"=>"unchecked"];
                    array_push($documents, $renderDoc);
                }
            }
		$level_id = $request->id;
		$salary = $levelDetails->salary;
		$name = $levelDetails->title;
            return view('admin.staff.data.editLevel',compact(['documents','level_id','salary','name']));
            
        }




        $requiredDoc = "";
        $count = sizeof($request->selectedDoc);
       	//dd($request->selectedDoc); 
            foreach($request->selectedDoc as $selected){
                $requiredDoc = $selected.",".$requiredDoc ;
            }
        $levels = \App\Level::where('id',$request->id)->update(["title"=>$request->name,"salary"=>$request->salary,"required_doc_ids"=>$requiredDoc]);
        if($levels){
            $message = "level Updated Successfully";
	    $levels = \App\Level::all();
            return view('admin.staff.data.viewLevel',compact(['message','levels']));
        }
    }



    public function deleteLevel(Request $request){

        $levels = \App\Level::where('id',$request->id)->delete();
        if($levels){
            $message = "level Deleted Successfully";
            return view('admin.staff.data.viewLevel',compact('message'));
        }
    }

    //crud for Level Ends


    //crud for Unit Starts
    public function createUnit(Request $request){
	if(isset($request->submit) && $request->submit == "createUnit"){

	    $unit = \App\Unit::where('title',$request->title)->exists();
	
	    if($unit){
		return redirect()->with("message","Unit Already Exists");
	     }

            $create = new \App\Unit([

                "title"=>$request->name,
            ]);
              if($create->save()){

                // return response()->json([
                //     "status"=> "200",
                //     "message"=>"Saved Successfully"
                // ]);
		
                return redirect()->back()->with("message","Unit Creted Successfully");
              }
            }else{

		return view('admin.staff.data.createUnit');
	    }
            
        
    }


    public function viewUnit(Request $request){
     	$units = \App\Unit::all();   
        return view('admin.staff.data.viewUnit',compact('units'));
        
    }


    public function updateUnit(Request $request){

        
        
        $unit = \App\Unit::where('id',$request->id)->update(["title"=>$request->name]);
        if($unit){
            $message = "unit Updated Successfully";
            return view('admin.staff.level.viewLevel',compact('message'));
        }
    }



    public function deleteUnit(Request $request){

        $unit = \App\Unit::where('id',$request->id)->delete();
        if($unit){
            $message = "Unit Deleted Successfully";
            return view('admin.staff.level.viewLevel',compact('message'));
        }
    }
}




