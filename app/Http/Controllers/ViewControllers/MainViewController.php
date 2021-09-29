<?php

namespace App\Http\Controllers\ViewControllers;
use App\Countries;
use App\DocumentStorage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Offices;
use App\LeaveRequest;
use App\Office;
use App\User;
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
use SweetAlert;
use App\Http\Controllers\BaseController;
//use Auth;
use Illuminate\Support\Facades\Auth;
class MainViewController extends BaseController
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
        $countries = Countries::all();
        return view('admin.createOffice', compact('levels', 'countries'));
    }

    public function viewStaffTable(){
        $staff = \App\User::all();
        return view('admin.staff.viewStaffTable',compact('staff'));

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
                return view('admin.staff.createCompanyInfo', compact(['personalInfo','offices','selectedBank','resumptionTypes','levels','units','banks','departments']));
            }
            return view('admin.staff.createCompanyInfo', compact(['personalInfo','offices','resumptionTypes','levels','units','banks','departments']));
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
                'staff_number'=> ''
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

    //crud for Level Starts
    public function createLevel(Request $request){

        if(isset($request->submit) && $request->submit == "createLevel"){
            $requiredDoc = "";
            //$count = sizeof($request->selectedDoc);
            //dd($request);
            if (!isset($request->selectedDoc)){
                alert()->error('Please make a selection.', 'No Selection');
                return redirect()->back();
            }
            foreach($request->selectedDoc as $selected){
                $requiredDoc = $selected.",".$requiredDoc ;
            }
            $requiredD = rtrim($requiredDoc, ",");
            $check = \App\Level::where("title",$request->name)->exists();
            if($check){
                $documents = \App\Document_table::all();

                alert()->error("Level already Exist", 'Success');
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

                alert()->success("Level Created Successfully", 'Success');
                return redirect()->back()->with("message","Level Created Successfully",compact('documents'));
            }


        }else{
            $documents = \App\Document_table::all();
            return view('admin.staff.data.createLevel',compact('documents'));
        }
    }

    public function viewLeave(Request $request){

        $offtypes = \App\OffType::all();

        return view('admin.staff.data.viewLeave',compact('offtypes'));

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

    public function viewLeaveCategory(Request $request){

        $offcategories = \App\OffCategory::all();

        return view('admin.staff.data.viewLeaveCategory',compact('offcategories'));

    }

    public function updateDeleteLeaveType(Request $request){
        //dd($request);
        if(isset($request->submit) && $request->submit == "update"){
            $offType = \App\OffType::where("id",$request->id)->update(["type"=>$request->type,"days"=>$request->days]);
            //dd($request);
            if($offType){
                alert()->success("Updated Successfully", 'Success');
                return redirect()->back()->with("message","Updated Successfully");
            }else{
                alert()->error("An error occurred while updating", 'Success');
                return redirect()->back()->with("message","An error occurred while updating");
            }
        }else if($request->submit == "delete"){

            $resumptionTypes = \App\ResumptionType::where("id",$request->id)->delete();
            if($resumptionTypes){
                alert()->success("Deleted Successfully", 'Success');
                return redirect()->back()->with("message","Deleted Successfully");
            }else{
                alert()->success("Could not delete this Level", 'Success');
                return redirect()->back()->with("message","Could not delete this Level");
            }
        }elseif($request->submit == "save"){
            $offtype = new \App\OffType([
                "type"=>$request->type,
                "days"=>$request->days,
            ]);
            if($offtype->save()){
                $offtypes = \App\OffType::all();
                alert()->success("Leave Type Successfully Created", 'Success');
                return redirect()->back()->with("message","Leave Type Successfully Created");

            }

        }
//	return view('admin.staff.data.createLeave');
    }

    public function createLeaveType(){
        //dd("here");
        return view('admin.staff.data.createLeaveType');
    }

    public function createLeaveCategory(){
        //dd("here");
        return view('admin.staff.data.createLeaveCategory');
    }

    public function updateDeleteLeaveCategory(Request $request){
        //dd($request);
        if(isset($request->submit) && $request->submit == "update"){
            $data = \App\OffCategory::where("id",$request->id)->update(["category"=>$request->type,"days"=>$request->days]);
            //dd($request);
            if($data){
                alert()->success("Updated Successfully", 'Success');
                return redirect()->back()->with("message","Updated Successfully");
            }else{
                alert()->error("Could not update", 'Success');
                return redirect()->back()->with("message","Could not update");
            }
        }else if($request->submit == "delete"){

            $data = \App\OffCategory::where("id",$request->id)->delete();
            if($data){
                alert()->success("Deleted Successfully", 'Success');
                return redirect()->back()->with("message","Deleted Successfully");
            }else{
                alert()->success("Could not Delete this category", 'Success');
                return redirect()->back()->with("message","Could not Delete this Category");
            }
        }elseif($request->submit == "save"){
            $data = new \App\OffCategory([
                "category"=>$request->type,
                "days"=>$request->days,
            ]);
            if($data->save()){
                $data = \App\OffCategory::all();
                alert()->success("Created Successfully", 'Success');
                return redirect()->back()->with("message","Leave Category Created Successfully");

            }

        }

    }


    //crud for resumption types

    public function createResumption(Request $request){
        //dd($request);
        if(isset($request->submit) && $request->submit == "createResumption"){
            $check = \App\ResumptionType::where('title',$request->title)->exists();

            if($check){

                return redirect()->back()->with("message","Resumption already exists");

            }
            $create = new \App\ResumptionType([

                "title"=>$request->title,
                "starttime"=>$request->starttime,
                "endtime"=> $request->endtime,
            ]);
            if($create->save()){

                return redirect()->back()->with("message","Resumption Created Successfully");
            }
        }else{

            return view("admin.staff.data.createResumption");
        }
    }


    public function viewResumption(Request $request){
        $resumptionTypes = \App\ResumptionType::all();//dd($resumptionTypes);
        return view("admin.staff.data.viewResumption",compact("resumptionTypes"));
    }


    public function updateAndDeleteResumption(Request $request){

        if(isset($request->submit) && $request->submit == "update"){
            $resumptionTypes = \App\ResumptionType::where("id",$request->id)->update(["title"=>$request->title,"starttime"=>$request->starttime,"endtime"=>$request->endtime]);

            if($resumptionTypes){
                $resumptionTypes = \App\ResumptionType::all();
                $message = "Resumption Updated Successfully";
                return view("admin.staff.data.viewResumption",compact("resumptionTypes"))->with("message",$message);
            }else{
                $message = "Resumption Could not be Updated Successfully";
                $resumptionTypes = \App\ResumptionType::all();
                return view("admin.staff.data.viewResumption",compact("resumptionTypes"))->with("message",$message);
            }
        }else if($request->submit == "delete"){

            $resumptionTypes = \App\ResumptionType::where("id",$request->id)->delete();
            if($resumptionTypes){
                $resumptionTypes = \App\ResumptionType::all();
                $message = "Resumption Deleted Successfully";
                return view("admin.staff.data.viewResumption",compact("resumptionTypes"))->with("message",$message);
            }else{
                $resumptionTypes = \App\ResumptionType::all();
                $message = "Resumption Could not be Deleted Successfully";
                return view("admin.staff.data.viewResumption",compact("resumptionTypes"))->with("message",$message);
            }
        }

    }


    //crud for Document types
    public function createDocument(Request $request){
        if(isset($request->submit) && $request->submit == "createDocument"){
            $create = new \App\Document_table([
                "name"=>$request->title,
            ]);
            if($create->save()){

                return redirect()->back()->with("message","Document Created Successfully");
            }
        }else{

            return view("admin.staff.data.createDocument");
        }
    }

    public function viewDocument(Request $request){
        $document_table = \App\Document_table::all();
        return view("admin.staff.data.viewDocument",compact("document_table"));
    }


    public function updateAndDeleteDocument(Request $request){
        //dd($request);
        if(isset($request->submit) && $request->submit == "update"){
            $document_table = \App\Document_table::where("id",$request->id)->update(["name"=>$request->name]);

            if($document_table){
                $document_table = \App\Document_table::all();
                $message = "Document Updated Successfully";
                return view("admin.staff.data.viewDocument",compact("document_table"))->with("message",$message);
            }else{
                $document_table = \App\Document_table::all();
                $message = "Document Could not be Updated Successfully";
                return view("admin.staff.data.viewDocument",compact("document_table"))->with("message",$message);
            }
        }else if($request->submit == "delete"){

            $document_table = \App\Document_table::where("id",$request->id)->delete();
            if($document_table){
                $document_table = \App\Document_table::all();
                $message = "Document Deleted Successfully";
                return view("admin.staff.data.viewDocument",compact("document_table"))->with("message",$message);
            }else{
                $document_table = \App\Document_table::all();
                $message = "Document Could not be Deleted Successfully";
                return view("admin.staff.data.viewDocument",compact("document_table"))->with("message",$message);
            }
        }

    }







    //crud for Status types

    public function createStatus(Request $request){
        if(isset($request->submit) && $request->submit == "createStatus"){
            $create = new \App\Status([
                "title"=>$request->title,
            ]);
            if($create->save()){

                return redirect()->back()->with("message","Status Created Successfully");
            }
        }else{
            return view("admin.staff.data.createStatus");
        }
    }


    public function viewStatus(Request $request){
        $status = \App\Status::all();
        return view("admin.staff.data.viewStatus",compact("status"));
    }


    public function updateAndDeleteStatus(Request $request){

        if(isset($request->submit) && $request->submit == "update"){
            $status = \App\Status::where("id",$request->id)->update(["title"=>$request->title]);

            if($status){
                $message = "Document Updated Successfully";
                return view("admin.staff.data.viewStatus")->with("message",$message);
            }else{
                $message = "Resumption Could not be Updated Successfully";
                return view("admin.staff.data.viewStatus")->with("message",$message);
            }
        }else if($request->submit == "delete"){

            $status = \App\Status::where("id",$request->id)->delete();
            if($status){
                $message = "Document Deleted Successfully";
                return view("admin.staff.data.viewStatus")->with("message",$message);
            }else{
                $message = "Status Could not be Deleted Successfully";
                return view("admin.staff.data.viewStatus")->with("message",$message);
            }
        }

    }








    //crud for Status Role
    public function createStaffRole(Request $request){
        if(isset($request->submit) && $request->submit == "createRole"){
            $create = new \App\StaffRole([
                "role"=>$request->role,
            ]);
            if($create->save()){

                return redirect()->back()->with("message","Role Created Successfully");
            }
        }else{
            return view("admin.staff.data.createRole");
        }
    }


    public function viewStaffRole(Request $request){
        $staffRole = \App\StaffRole::all();
        return view("admin.staff.data.viewRole",compact("staffRole"));
    }


    public function updateAndDeleteStaffRole(Request $request){

        if(isset($request->submit) && $request->submit == "update"){
            $staffRole = \App\StaffRole::where("id",$request->id)->update(["role"=>$request->role]);
            if($staffRole){
                $message = "Staff role Updated Successfully";
                $staffRole = \App\StaffRole::all();
                return view("admin.staff.data.viewRole",compact("staffRole"))->with("message",$message);
            }else{
                $message = "Staff Role Could not be Updated Successfully";
                $staffRole = \App\StaffRole::all();
                return view("admin.staff.data.viewRole",compact("staffRole"))->with("message",$message);
            }
        }else if($request->submit == "delete"){

            $status = \App\Status::where("id",$request->id)->delete();
            if($status){
                $staffRole = \App\StaffRole::all();
                $message = "Staff Role Deleted Successfully";
                return view("admin.staff.data.viewStaffRole",compact("staffRole"))->with("message",$message);
            }else{
                $staffRole = \App\StaffRole::all();
                $message = "Status Could not be Deleted Successfully";
                return view("admin.staff.data.viewRole",compact("staffRole"))->with("message",$message);
            }
        }

    }


    //crud for Offenses types
    public function createOffence(Request $request){
        if(isset($request->submit) && $request->submit == "createOffence"){
            $create = new \App\Offence([
                "name"=>$request->name,
                "amount"=>$request->amount
            ]);
            if($create->save()){

                return redirect()->back()->with("message","Offence Created Successfully");
            }
        }else{
            return view("admin.staff.data.createOffence");
        }
    }


    public function viewOffence(Request $request){
        $offence = \App\Offence::all();
        return view("admin.staff.data.viewOffence",compact("offence"));
    }


    public function updateAndDeleteOffence(Request $request){

        if(isset($request->submit) && $request->submit == "update"){
            $staffRole = \App\Offence::where("id",$request->id)->update(["name"=>$request->name]);

            if($staffRole){
                $offence = \App\Offence::all();
                $message = "Staff Offence Updated Successfully";
                return view("admin.staff.data.viewOffence",compact('offence'))->with("message",$message);
            }else{
                $message = "Staff Offence Could not be Updated Successfully";
                $offence = \App\Offence::all();
                return view("admin.staff.data.viewOffence",compact('offence'))->with("message",$message);
            }
        }else if($request->submit == "delete"){

            $status = \App\Offence::where("id",$request->id)->delete();
            if($status){
                $message = "Staff offence Deleted Successfully";
                $offence = \App\Offence::all();
                return view("admin.staff.data.viewOffence",compact('offence'))->with("message",$message);
            }else{
                $message = "Offence Could not be Deleted Successfully";
                $offence = \App\Offence::all();
                return view("admin.staff.data.viewOffence",compact('offence'))->with("message",$message);
            }
        }
    }
}