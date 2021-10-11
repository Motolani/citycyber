<?php

namespace App\Http\Controllers;

use App\Department;
use App\IncidenceOpration;
use App\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;

class OfficeController extends BaseController
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

        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.home');
    }



    public function getAllOffice(){
        $offices = new Offices();
        $getOffice = $offices->GetAllOffice();
        return view('admin.viewOffices')->with("offices",$getOffice);
    }

    public function officeInfo(Request $request){

        $office = Office::where('id',$request->id)
            ->withCount("staffs")
            ->first();

        //get list of all staff in this office that clocked in today
        $staffPresent = \App\Attendance::where('office_id', $office->id)->whereDay('created_at', now()->day)->count();
        $staffAbsent = $office->staffs_count - $staffPresent;
        $staffsOnLeave = [];

        //Get all Depatments the Office has.  Officeid field might need to be added
        $departments = Department::where('id', '>', 0)
            //->where('office_id', $office->id)
            ->get();

        //Loop through Office Staff
        foreach ($office->staffs as $staff){
            if($staff->isOnLeave()){
                $staffsOnLeave[] = $staff;
            }
        }

        return view('admin.offices.officeInfo',compact('office', 'staffAbsent', 'staffsOnLeave', 'departments'));
    }

    public function updateOffice(Request $request){
        $updateOffice = Office::where('id',$request->id)->update(["name"=>$request->name,"emailAddress"=>$request->emailAddress,"phone"=>$request->phone,"location"=>$request->address]);
        if($updateOffice){
            alert()->success("Office info Updated Successfully", 'Success');
            return redirect()->back()->with("message","Office info Updated Successfully");
        }else{
            alert()->error("Office info could not be updated", 'Success');
            return redirect()->back()->with("message","Office info could not be updated.");
        }
    }

    public function createStore(Request $request, $officeId){
        $updateOffice = Office::where('id',$officeId)->update(["has_store"=>true]);
        if($updateOffice){
            alert()->success("Office Store have been created Successfully", 'Success');
            return redirect()->back()->with("message","Office Store have been created Successfully");
        }else{
            alert()->error("Office Store could not be created", 'Error');
            return redirect()->back()->with("error","Office Store could not be created");
        }
    }



    public function createOfficeRequest(Request $request){

        //dd($request);
        $officeCode = $request->officeCode;
        $name = $request->name;
        $email = $request->email;
        $office_code = $request->officeCode;
        $phone = $request->phone;
        $location = $request->location;
        $countryId = $request->country;
        $stateId = $request->state;
        $cityId = $request->city;
        $managerId = "";
        $type=$request->officeType;
        $level =$request->officeLevel;
        $parentOfficeId =$request->officeLevel;



        $office = new Office();
        $office->name = $name;
        $office->emailAddress = $email;
        $office->phone = $phone;
        $office->office_code = $office_code;
        $office->location = $location;
        $office->country_id = $countryId;
        $office->city_id = $cityId;
        $office->lga = '';
        $office->state_id = $stateId;
        $office->managerid = $request->managerid;
        $office->type = $type;
        $office->level = $level;
        $office->parentOfficeId = $parentOfficeId;
        $office->save();

        alert()->success("Office Created Successfully", 'Office Created');
        return redirect()->back()->with("status","Office Created Successfully");


        //Absolutely useless lines of codes
//        $createStatus = $offices->CreateOffice($req);
//        if($createStatus == 1){
//            return redirect()->back()->with("status","Office Created Successfully");
//        }
//        elseif($createStatus){
//            return redirect()->back()->with("status",$createStatus );
//        }
    }



}
