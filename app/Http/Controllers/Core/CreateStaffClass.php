<?php
namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\User;
use App\Office;
use App\Staff;
use App\OfficeLevel;
use App\StaffBankAcc;
use App\Bank;
use App\Status;
use App\Unit;
use App\Department;
use App\DepartmentRole;
use App\Guarantor;
use App\Level;
use App\Position;
use App\ResumptionType;
use App\Document;
use App\DocStorage;
use App\WorkExperience;
use App\EducationType;
use App\Qualification;
use App\Classe;
use App\Education;
use App\NextOfKin;
use App\EmergencyContact;

class CreateStaffClass extends Controller{

    public function __construct(){

    }

    //Personal Infos
    function creatStaff(Request $request,$data){//dd($data);
        $personalInfo = $data['personalInfo'];
        $companyInfo = $data['companyInfo'];
        $workEducation = $data['workEducation'];

        $firstName = $personalInfo["firstName"];
        $middleName = $personalInfo["middleName"];
        $lastName = $personalInfo["lastName"];
        $residentialAddress = $personalInfo["residentialAddress"];
        $homeAddress = $personalInfo["homeAddress"];
        $phone = $personalInfo["phone"];
        $email = $personalInfo["email"];
        $state = $personalInfo["state"];
        $lga = $personalInfo["lga"];
        $dob = $personalInfo["dob"];
        $gender = $personalInfo["gender"];
        $maritalStatus = $personalInfo["maritalStatus"];
        $nextofkinName = $personalInfo["nextofkinName"];
        $nextofkinRelationship = $personalInfo["nextofkinRelationship"];
        $nextofkinPhone = $personalInfo["nextofkinPhone"];
        $nextofkinAddress = $personalInfo["nextofkinAddress"];
        $nextofkinContact = $personalInfo["nextofkinContact"];
        $emmergencyPhone = $personalInfo["emmergencyPhone"];
        $emergencyAddress = $personalInfo["emergencyAddress"];
        $imgUrl = $personalInfo["imgUrl"];


        //company Infos
        $staffStatus = $companyInfo["status"];
        $staffBranch = $companyInfo["staffBranch"];
        $bank = $companyInfo["bank"];
        $accountName = $companyInfo["accountName"];
        $accountNumber = $companyInfo["accountNumber"];
        $gender = $companyInfo["gender"];
        $staffUnit = $companyInfo["staffUnit"];
        $staffDepartment = $companyInfo["staffDepartment"];
        $staffDepartmentRole = $companyInfo["staffDepartmentRole"];
        $resumptionDate = $companyInfo["resumptionDate"];
        $assumptionDate = $companyInfo["assumptionDate"];
        $resumptionType = $companyInfo["resumptionType"];
        $terminationDate = $companyInfo["terminationDate"];
        $guarantorName = $companyInfo["g_name"];
        $guarantorPhone = $companyInfo["g_phone"];
        $guarantorEmail = $companyInfo["g_email"];
        $guarantorOfficeAddress = $companyInfo["g_office_address"];
        $guarantorHomeAddress = $companyInfo["g_home_address"];
        $staffLevel = $companyInfo["staffLevel"];
        
        //Workand Educational Details
        $establishment_name = $workEducation["establishment_name"];
        $work_start_year = $workEducation["work_start_year"];
        $work_end_year = $workEducation["work_end_year"];
        $position_held = $workEducation["position_held"];
        $job_functions = $workEducation["job_functions"];
        $education_type_id = $workEducation["education_type_id"];
        $start_year = $workEducation["start_year"];
        $end_year = $workEducation["end_year"];
        $course_name = $workEducation["course_name"];
        $education_qual_id = $workEducation["education_qual_id"];
        
	//explode all options to get their ids
	$ex= explode("|",$companyInfo['bank']);
        $bank =$ex[0]; 
	$expUnit= explode("|",$companyInfo['staffUnit']);
        $staffUnit = $expUnit[0];
	$expBranch= explode("|",$companyInfo['staffBranch']);
        $staffBranch = $expBranch[0]; 
	$expdept = explode("|",$companyInfo['staffDepartment']);
        $staffDepartment = $expdept[0];
	$expRespType = explode("|",$companyInfo['resumptionType']);
	$resumptionType = $expRespType[0];	
	$expLevel = explode("|",$companyInfo['staffLevel']);
	$staffLevel = $expLevel[0];


        $staff = new User([
            "firstname"=>$firstName,
            "middlename"=>$middleName,
            "lastname"=>$lastName,
            "homeAddress"=>$homeAddress,
            "residentialAddress"=>$residentialAddress,
            "phone"=>$phone,
            "email"=>$email,
            "password"=>"",
            "DOB"=>$dob,
            "state"=>$state,
            "status"=>"GM",
            "level"=>$staffLevel,
            "resumptionType"=>$resumptionType,
            "imgUrl"=>$imgUrl,
            "branchId"=>$staffBranch,
            "unit"=>$staffUnit,
            "department"=>$staffDepartment,
            "departmentrole"=>$staffDepartmentRole,
            "position"=>"",//$position_held,
            "resumptionDate"=>$resumptionDate,
            "assumptionDate"=>$assumptionDate,
            "lga"=>$lga,
            "country"=>"Nigeria",
            "gender"=>$gender,
            "maritalstatus"=>$maritalStatus,
            "username"=>$firstName,
        ]);
       //dd($staff); 
        if($staff->save()){
	 //   dd("saved!!");
            $staffId = $staff->id;
            
            $eperience = new Request([
                "staffId"=> $staffId,"nameOfEstablish"=>$establishment_name,"position"=>$position_held,"job_functions"=>$job_functions,"startyear"=>$start_year,"endyear"=>$end_year,
            ]);
            if($this->workExperience($eperience)){
                
                //createStaffbankacc
                $createStaffbankacc = new Request([
                    "staffId"=>$staffId,"bankname"=>$bank,"acc_num"=>$accountNumber,"acc_name"=>$accountName,"acc_type"=>"",
                ]);
                if($this->createStaffbankacc($createStaffbankacc)){

                    //call Create emergencyContact
                    $emergencyContact = new Request([
                        "staffId"=>$staffId,"name"=>"N","phone"=>$emmergencyPhone,"address"=>$emergencyAddress,
                    ]);
                    if($this->emergencyContact($emergencyContact)){

                        //creat guarantors
                        $guarantors = new Request([
                            "staffId"=>$staffId,"name"=>$guarantorName,"phone"=>$guarantorPhone,"email"=>$guarantorEmail,"officeAddress" =>$guarantorOfficeAddress,"homeAddress"=>$guarantorHomeAddress
                        ]);
                        if($this->guarantors($guarantors)){
                            //nextofkins
                            $nextofkins = new Request([
                                "staffId"=>$staffId,"name"=>$nextofkinName,"relationship"=>$nextofkinRelationship,"phone"=>$nextofkinPhone,"address"=>$nextofkinAddress,
                            ]);

                            if($this->nextofkins($nextofkins)){
                                
                                return response()->json([
                                "status"=>"200",
                                "message"=>"Employee has been created Successfully",
				                ]);
                                
                            }else{
                                return response()->json([
                                    "status"=>"300",
                                    "message"=>"Staff's other documents(next of kin) could not be created",
                                    ]);
                            }
                        }else{
                            return response()->json([
                                "status"=>"300",
                                "message"=>"Staff's other documents(guarantor,next of kin) could not be created",
                                ]);
                        }
                        
                    }else{
                        return response()->json([
                            "status"=>"300",
                            "message"=>"Staff's other documents(bank account,guarantor,next of kin) could not be created",
                            ]);
                    }


                }else{
                    return response()->json([
                        "status"=>"300",
                        "message"=>"Staff's other documents(emmergency,bank account,guarantor,next of kin) could not be created",
                        ]);
                }

            }else{
                return response()->json([
                    "status"=>"300",
                    "message"=>"Staff's other documents(work Experience, emmergency, work experience, bank account,guarantor,next of kin) could not be created",
                    ]);
            }
            
        }else{
            return response()->json([
                      "status"=>"300",
                      "message"=>"Could not create Employee, please try again later. Thank you",
                      ]);

        }

        
    }

     function workExperience($request){      
        $len = sizeof($request->position);

        for($i = 0; $i<$len;$i++){
            Log::info("insideLoop ".$i);
            try{ $workExperience = new WorkExperience([
                    "userId"=>$request->staffId,
                    "nameOfEstablish"=>$request->nameOfEstablish[$i],
                    "position"=>$request->position[$i],
                    "jobFunction"=>$request->job_functions[$i],
                    "startyear"=>$request->start_year[$i],
                    "endyear"=>$request->end_year[$i],
                ]);
                if($workExperience->save()){
                    $result =  true;
                }else{
                    $result = false;
                }
            }
            catch(Exception $ex){
        //	dd($ex);
            }
        }
        return $result;
    }


     function createStaffbankacc($data){//dd($data);
        $len = $len = sizeof($data->accountNumber);
        $result = false;
       	//dd($data); 
            $createStaffbankacc = new StaffBankAcc([
                "userId"=>$data->staffId,
                "bankname"=>$data->bankname,
                "acc_num"=>$data->acc_num,
                "acc_name"=>$data->acc_name,
                "acc_type"=>"savin",
            ]);
            if($createStaffbankacc->save()){
                $result =  true;
            }else{
                $result =  false;
            }
        
        return $result;

        
    }


    function emergencyContact($data){
	//dd($data);
        $emergencyContact = new EmergencyContact([
            "userId"=>$data->staffId,
            "name"=>$data->name,
            "phone"=>$data->phone,
            "address"=>$data->address,
        ]);
        if($emergencyContact->save()){
            return true;
        }else{
            return false;
        }

        
        
    }





    function guarantors($data){
        $len = sizeof($data->name);
        $result = false;    
	//dd($data);
        for($i = 0; $i<$len;$i++){
            $guarantors = new Guarantor([
                "userId"=>$data->staffId,
                "name"=>$data->name[$i],
                "phone"=>$data->phone[$i],
                "email"=>$data->email[$i],
                "officeAddress" =>$data->officeAddress[$i],
                "homeAddress"=>$data->homeAddress[$i]
            ]);
            if($guarantors->save()){
                $result = true;
            }else{
                $result = false;
            }
        }
        return $result;
    
    }


    function nextofkins($data){
        
        $len =  sizeof($data->name);
        $result = false;    

        for($i = 0; $i<$len;$i++){
        
            $nextofkins = new NextOfKin([
                "userId"=>$data->staffId,
                "name"=>$data->name[$i],
                "relationship"=>$data->relationship[$i],
                "phone"=>$data->phone[$i],
                "address"=>$data->address[$i],
            ]);
            if($nextofkins->save()){
                $result =  true;
            }else{
                $result =  false;
            }
        }
        return $result;

        
    }

    //nextofkins

}



