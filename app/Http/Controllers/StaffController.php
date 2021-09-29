<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Department;
use App\Document;
use App\Document_table;
use App\DocumentStorage;
use App\Education;
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

        $testExperience = [
            'education_type' => ['Edu 1', 'University'],
            'institution_name' => ['Middlesex University', 'University of Mauritius'],
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
        $request->session()->put('workEducation', $testExperience);
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
        //Validate Personal Information
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

        //Validate Company Information
        $validateCompanyInfo = $request->validate([
            'status' => 'required',
            'staffBranch' => 'required',
            'bank' => 'required',
            'accountName' => 'required',
            'accountNumber' => 'required',
            'gender' => 'required',
            'staffCode' => 'required',
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
            'institution_name' => '',
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

        $request->session()->put('personalInfo', $validatePersonalInfo);
        $request->session()->put('companyInfo', $validateCompanyInfo);
        $request->session()->put('workEducation', $validateExperience);

        $data = $request->session()->all();
        $this->creatStaff($request);

        alert()->success('Staff Created Successfully', '');
        return redirect('viewStaffTable')->with('message', "Staff Created Successfully'");
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

    function creatStaff(Request $request){
        $personalInfo = $request['personalInfo'];
        $companyInfo = $request['companyInfo'];
        $workEducation = $request['workEducation'];

        $firstName = $request["firstName"];
        $middleName = $request["middleName"];
        $lastName = $request["lastName"];
        $residentialAddress = $request["residentialAddress"];
        $homeAddress = $request["homeAddress"];
        $phone = $request["phone"];
        $email = $request["email"];
        $state = $request["state"];
        $lga = $request["lga"];
        $dob = $request["dob"];
        $gender = $request["gender"];
        $maritalStatus = $request["maritalStatus"];
        $nextofkinName = $request["nextofkinName"];
        $nextofkinRelationship = $request["nextofkinRelationship"];
        $nextofkinPhone = $request["nextofkinPhone"];
        $nextofkinAddress = $request["nextofkinAddress"];
        $nextofkinContact = $request["nextofkinContact"];
        $emmergencyPhone = $request["emmergencyPhone"];
        $emergencyAddress = $request["emergencyAddress"];

        //Photo
        $fileName = time() . '.' . $request->imgUrl->extension();
        $photoPath = $request->imgUrl->move('uploads', $fileName);


        //company Infos
        $staffStatus = $request["status"];
        $staffBranch = $request["staffBranch"];
        $bank = $request["bank"];
        $staffCode = $request["staffCode"];
        $accountName = $request["accountName"];
        $accountNumber = $request["accountNumber"];
        $gender = $request["gender"];
        $staffUnit = $request["staffUnit"];
        $staffDepartment = $request["staffDepartment"];
        $staffDepartmentRole = $request["staffDepartmentRole"];
        $resumptionDate = $request["resumptionDate"];
        $assumptionDate = $request["assumptionDate"];
        $resumptionType = $request["resumptionType"];
        $terminationDate = $request["terminationDate"];
        $guarantorName = $request["g_name"];
        $roleId = $request->accessLevel;
        $guarantorPhone = $request["g_phone"];
        $guarantorEmail = $request["g_email"];
        $guarantorOfficeAddress = $request["g_office_address"];
        $guarantorHomeAddress = $request["g_home_address"];
        $staffLevel = $request["staffLevel"];

        //Workand Educational Details
        $institution_name = $request["institution_name"];
        $work_start_year = $request["work_start_year"];
        $work_end_year = $request["work_end_year"];
        $position_held = $request["position_held"];
        $job_functions = $request["job_functions"];
        $start_year = $request["start_year"];
        $end_year = $request["end_year"];
        $course_name = $request["course_name"];
        $qualification = $request["qualification"];

        //explode all options to get their ids
        $ex= explode("|",$request['bank']);
        $bank =$ex[0];
        $expUnit= explode("|",$request['staffUnit']);
        $staffUnit = $expUnit[0];
        $expBranch= explode("|",$request['staffBranch']);
        $staffBranch = $expBranch[0];
        $expdept = explode("|",$request['staffDepartment']);
        $staffDepartment = $expdept[0];
        $expRespType = explode("|",$request['resumptionType']);
        $resumptionType = $expRespType[0];
        $expLevel = explode("|",$request['staffLevel']);
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
            $staff->roles()->attach($roleId);

            //Process Work Experience
            $this->workExperience($request);

            //Process Education
            $this->proccessEducation($request, $staff);


            //Proccess Bank Accounts
            $this->createStaffbankacc($request, $staff);

            //Process Emergency Contact
            //call Create emergencyContact
            $this->emergencyContact($request, $staff);


            //create guarantors
            $this->guarantors($request, $staff);


            //nextofkins
            $this->nextofkins($request, $staff);

        }
    }


    function workExperience($request) {
//        dd($request->all());
        $len = sizeof($request->position_held);
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

    function proccessEducation(Request $request, $staff) {
        $len = sizeof($request->institution_name);
        $result = true;

        for($i = 0; $i<$len;$i++){

            try {
                //Upload the Photo
                $fileName = time() . '.' . $request->document_photo[$i]->extension();
                $photoPath = $request->document_photo[$i]->move('uploads', $fileName);
                $education = new Education();
                $education->userId = $staff->id;
                $education->document_path = $photoPath;
                $education->endyear = $request->end_year[$i];
                $education->course = $request->course_name[$i];
                $education->startyear = $request->start_year[$i];
                $education->qualification = $request->qualification[$i];
                $education->educationType = $request->education_type[$i];
                $education->name_of_institution = $request->institution_name[$i];
                $education->save();
            } catch (\Exception $e) {
            }
        }
        return $result;
    }


    function createStaffbankacc($data, $staff){
        //dd($data->all());
        // dd($data->acc_num);
        // $len = $len = sizeof($data);
        $result = false;
        //dd($data);
        $createStaffbankacc = new StaffBankAcc([
            "userId"=>$staff->id,
            "bankname"=>$data->bank,
            "acc_num"=>$data->accountNumber,
            "acc_name"=>$data->accountName,
            "acc_type"=>"SAVINGS",
        ]);
        if($createStaffbankacc->save()){
            $result =  true;
        }else{
            $result =  false;
        }
        return $result;
    }


    function emergencyContact($data, $staff){
//        dd($data->all());
        $emergencyContact = new EmergencyContact([
            "userId"=>$staff->id,
            "name"=>$data->emergencyName,
            "phone"=>$data->emmergencyPhone,
            "address"=>$data->emergencyAddress,
        ]);
        if($emergencyContact->save()){
            return true;
        }else{
            return false;
        }
    }

    function guarantors($request, $staff){
        //dd($request->all());
        $len = count($request->g_photo);
        $result = false;

        for($i = 0; $i<$len;$i++){
            $fileName = time() . '.' . $request->g_photo[$i]->extension();
            $photoPath = $request->g_photo[$i]->move('uploads', $fileName);

            $guarantors = new Guarantor([
                "userId"=>$staff->id,
                "photo"=>$photoPath,
                "name"=>$request->g_name[$i],
                "phone"=>$request->g_phone[$i],
                "email"=>$request->g_email[$i],
                "officeAddress" =>$request->g_office_address[$i],
                "homeAddress"=>$request->g_home_address[$i]
            ]);
            if($guarantors->save()){
                $result = true;
            }else{
                $result = false;
            }
        }
        return $result;
    }

    function nextofkins($data, $staff){
        //dd($data->all());
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
            "userId"=>$staff->id,
            "name"=>$data->nextofkinName,
            "relationship"=>$data->nextofkinRelationship,
            "phone"=>$data->nextofkinPhone,
            "address"=>$data->nextofkinAddress,
        ]);
        if($nextofkins->save()){
            $result =  true;
        }else{
            $result =  false;
        }
        return $result;
    }

    public function viewStaffProfile(Request $request){
        $user_id = $request->user_id;
        $staff = User::find($user_id);
        $workExperience = WorkExperience::where('userId',$user_id)->first();

        $staffBankAcc = StaffBankAcc::where('userId',$user_id)->first();

        $emmergencyContact = EmergencyContact::where('userId',$user_id)->first();

        $guarantor = Guarantor::where('userId',$user_id)->first();

        $requiredDocuments = "";
        $required_doc = [];

        //Get required documents
        $level = Level::where('id', $staff->level)->first();
        $strr = explode(",",$level->required_doc_ids);

        $count = sizeof($strr);
        for($i = 0; $i<$count;$i++){
            array_push($required_doc, $strr[$i]);
        }

        $check = DocumentStorage::where("userId",$staff->id)->exists();
        if($check){
            $uploadedDocsIds = [];
            $user_docs = DocumentStorage::where("userId",$staff->id)->get();
            foreach ($user_docs as $doc)
            {
                $uploadedDocsIds[] = $doc->docId;
            }
            $docsNotUploaded = Document_table::whereIn('id', $required_doc)->whereNotIn('id', $uploadedDocsIds)->get();

        }else{
            return response()->json([
                'status'=>'300',
                'message'=>'Documents retreived Successfully',
                'data' =>$required_doc,

            ]);
        }

        $nextOfKin = NextOfKin::where('userId',$user_id)->first();//dd('here');
        return view('admin.staff.staffProfile', compact(['staff','workExperience','staffBankAcc','emmergencyContact','guarantor','nextOfKin','requiredDocuments', 'docsNotUploaded']));
    }

}