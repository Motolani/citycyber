<?php

namespace App\Http\Controllers;

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
