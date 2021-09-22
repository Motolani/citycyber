<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Department;
use App\EmergencyContact;
use App\Guarantor;
use App\IncidenceOpration;
use App\Level;
use App\NextOfKin;
use App\Office;
use App\ResumptionType;
use App\Role;
use App\StaffBankAcc;
use App\Unit;
use App\User;
use App\WorkExperience;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Log;

class StaffController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Add this line to call Parent Constructor from BaseController
        parent::__construct();

        $this->middleware(['auth']);
    }

    public function index()
    {
    }

    public function viewNewStaff(Request $request){
        $staffCode = $this->generateStaffCode();

        //************************* Strictly for testing this shit *************************
        $testPersonalInfo = [
            'firstName' => 'Efetobor',
            'middleName' => 'Owen',
            'lastName' => 'Agbontaen',
            'residentialAddress' => 'No 11 ',
            'homeAddress' => 'No 11 ',
            'phone' => '09081552310',
            'email' => 'agbontaenefe@gmail.com',
            'state' => 'Lagos',
            'lga' => 'Alimosho',
            'dob'=>'27/04/1994',
            'imgUrl' =>'',
            'gender' => 'Male',
            'maritalStatus' => 'Single',
            'nextofkinName' => 'Efe',
            'nextofkinRelationship' => 'Me',
            'nextofkinPhone' => '08052369055',
            'nextofkinAddress' => 'No 22',
            'nextofkinContact' => 'No 22',
            'emmergencyPhone' => '090887546',
            'emergencyAddress' => 'address',
        ];

        $testCompanyInfo = [
            'status' => 'Regular',//Default
            'staffBranch' => 'HQ|',
            'bank' => 'Access Bank|',
            'accountName' => 'Agbontaen Efetobor',
            'accountNumber' => '0050866168',
            'gender' => 'Male',
            'staffUnit' => 'REGULAR SUPPORT|',
            'staffDepartment' => 'SECURITY|',
            'staffDepartmentRole' => 'Member',//Default
            'staffLevel' => 'required|',
            'g_name' => ["Efe"],
            'g_phone'=> ["07099886579"],
            'g_email'=> ["admin@efe.com"],
            'g_office_address'=> ["23, Becky Lane"],
            'g_home_address'=> ["23, Becky Lane"],
            'resumptionDate' => '2021-09-20',
            'assumptionDate' => '2021-09-20',
            'terminationDate' => '2021-09-20',
            'resumptionType' => 'Day|',
            'staff_number'=> ''
        ];

        $validateExperience = [
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
        ];
        $request->session()->put('personalInfo', $testPersonalInfo);
        $request->session()->put('companyInfo', $testCompanyInfo);
        //************************* Strictly for testing this shit *************************



        $companyInfo = $request->session()->get('companyInfo');
        $departments = Department::all();
        $banks = Bank::all();
        $units = Unit::all();
        $levels = Level::all();
        $roles = Role::all();
        $resumptionTypes = ResumptionType::all();
        $offices = Office::all();

        return view('admin.staff.newStaff', compact('staffCode','companyInfo','offices','resumptionTypes','levels','units','banks','departments', 'roles'));
    }

    function submitStaffForm(Request $request){
        $validatePersonalInfo = $request->validate([
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

        $validateCompanyInfo = $request->validate([
            'status' => 'required',
            'staffBranch' => 'required',
            'bank' => 'required',
            'accountName' => 'required',
            'accountNumber' => 'required',
            'gender' => 'required',
            'staffUnit' => 'required',
            'staffCode' => 'required',
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
            'staff_number'=> ''
        ]);

        $validateExperience = $request->validate([
            'establishment_name' => '',
            'work_start_year' => '',
            'work_end_year' => '',
            'position_held' => '',
            'job_functions' => '',
            'education_type_id' => '',
            'start_year' => '',
            'end_year' => '',
            'institution_name' => '',
            'course_name' => '',
            'education_qual_id' => '',
            'education_class_id' => '',
        ]);
        $request->validate(['imgUrl' => 'required|mimes:jpg,png']);

        $personalInfo = $request->session()->put('personalInfo', $validatePersonalInfo);
        $companyInfo = $request->session()->put('companyInfo', $validateCompanyInfo);
        $experience = $request->session()->put('workEducation', $validateExperience);

        if(isset($request->back) && $request->back == "Back"){
            if($request->session()->has('companyInfo')){
                $companyInfo = $request->session()->get('companyInfo');
                return view('admin.staff.createCompanyInfo', compact("companyInfo"));
            }
        }
        else{
            $data = $request->session()->all();
            $response = $this->creatStaff($request,$data);

            $response = json_decode($response->getContent());//dd($response->message);
            $message = $response->message;
            if($response->status == "200"){
                alert()->success('Staff Created Successfully', '');
                return redirect()->back();//->with('message', $response->message);
            }else{
                return redirect()->back();
            }
        }
    }

    function generateStaffCode($count=0){
        $baseId = 1000;
        $code = "CC-";
        //count all users, add 1 to it and add that to the baseId and add $count to it
        $baseId += User::where('id', '>', 0)->count()+1+$count;
        $code .= $baseId;

        //Check it does not exist
        $users = User::where('staff_code', $code)->count();
        //The code exists so increament count and do recursion
        if($users > 0){
            $this->generateStaffCode($count + 1);
        }

        return $code;
    }



    function creatStaff(Request $request,$data){
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

        //Photo
        $fileName = time() . '.' . $request->imgUrl->extension();
        $photoPath = $request->imgUrl->move('uploads', $fileName);


        //company Infos
        $staffStatus = $companyInfo["status"];
        $staffBranch = $companyInfo["staffBranch"];
        $bank = $companyInfo["bank"];
        $staffCode = $companyInfo["staffCode"];
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
        $roleId = $request->accessLevel;
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
            "imgUrl"=>$photoPath,
            "imgUrl"=>$photoPath,
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
        if($staff->save()) {
            $staffId = $staff->id;
        }
        $staff->roles()->attach($roleId);

        //Process Work Experience
        $eperience = new Request([
            "staffId"=> $staffId,"nameOfEstablish"=>$establishment_name,"position"=>$position_held,"job_functions"=>$job_functions,"startyear"=>$start_year,"endyear"=>$end_year,
        ]);
        $this->workExperience($eperience);


        //Proccess Bank Accounts
        $createStaffbankacc = new Request([
            "staffId"=>$staffId,"bankname"=>$bank,"acc_num"=>$accountNumber,"acc_name"=>$accountName,"acc_type"=>"",
        ]);
        $this->createStaffbankacc($createStaffbankacc);

        //Process Emergency Contact
        //call Create emergencyContact
        $emergencyContact = new Request([
            "staffId"=>$staffId,"name"=>"N","phone"=>$emmergencyPhone,"address"=>$emergencyAddress,
        ]);
        $this->emergencyContact($emergencyContact);


        //creat guarantors
        $guarantors = new Request([
            "staffId"=>$staffId,"name"=>$guarantorName,"phone"=>$guarantorPhone,"email"=>$guarantorEmail,"officeAddress" =>$guarantorOfficeAddress,"homeAddress"=>$guarantorHomeAddress
        ]);
        $this->guarantors($request, $guarantors);


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
    }

    function workExperience($request) {
        $len = sizeof($request->position);
        $result = false;
        for($i = 0; $i<$len;$i++){
            Log::info("insideLoop ".$i);
            try{
                $workExperience = new WorkExperience([
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
            catch(\Exception $ex){
                //dd($ex);
            }
        }
        return $result;
    }


    function createStaffbankacc($data){
        //dd($data);
        // dd($data->acc_num);
        // $len = $len = sizeof($data);
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

    function guarantors($request, $data){
        $len = count($request->g_photo);
        $result = false;

        for($i = 0; $i<$len;$i++){
            $fileName = time() . '.' . $request->g_photo[$i]->extension();
            $photoPath = $request->g_photo[$i]->move('uploads', $fileName);

            $guarantors = new Guarantor([
                "userId"=>$data->staffId,
                "photo"=>$photoPath,
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
        // dd($data);
        // $len =  sizeof($data->relationship);
        $result = false;

        // for($i = 0; $i<$len;$i++){

        // $nextofkins = new NextOfKin([
        //     "userId"=>$data->staffId,
        //     "name"=>$data->name[$i],
        //     "relationship"=>$data->relationship[$i],
        //     "phone"=>$data->phone[$i],
        //     "address"=>$data->address[$i],
        // ]);
        $nextofkins = new NextOfKin([
            "userId"=>$data->staffId,
            "name"=>$data->name,
            "relationship"=>$data->relationship,
            "phone"=>$data->phone,
            "address"=>$data->address,
        ]);
        if($nextofkins->save()){
            $result =  true;
        }else{
            $result =  false;
        }
        return $result;
    }
}