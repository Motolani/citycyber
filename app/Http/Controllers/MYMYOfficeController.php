<?php

namespace App\Http\Controllers;

use App\Department;
use App\IncidenceOpration;
use App\Office;
use App\OfficeStock;
use App\Reason;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Validator;

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

    public function getRegion(){
        $getRegion = Office::where('type', 'REGION')->get();
        // $getOffice = $offices->GetAllOffice();
        return view('admin.viewRegion')->with("regions",$getRegion);
    }
    
    public function getArea(){
        $getArea = Office::where('type', 'AREA')->get();
        // $getOffice = $offices->GetAllOffice();
        return view('admin.viewArea')->with("areas",$getArea);
    }

    public function getHubOne(){
        $getHubOne = Office::where('type', 'HUB1')->get();
        // $getOffice = $offices->GetAllOffice();
        return view('admin.viewHubOne')->with("hubOne",$getHubOne);
    }

    public function getHubTwo(){
        $getHubTwo = Office::where('type', 'HUB2')->get();
        // $getOffice = $offices->GetAllOffice();
        return view('admin.viewHubTwo')->with("hubTwo",$getHubTwo);
    }

    public function getBranches(){
        $getBranch = Office::where('type', 'like', 'BRANCH%')->get();
        // $getOffice = $offices->GetAllOffice();
        return view('admin.viewBranches')->with("branches",$getBranch);
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

        //Stocks soon to be due
        $dateThreshold = Carbon::today()->addWeek(2);
        $stocks = OfficeStock::where('to_office_id', $request->id)
            ->whereDate('due_date', '<=', $dateThreshold)
            ->get();

        $stockCount = OfficeStock::where('to_office_id', $request->id)
            ->count();


        //Get total of this Office Debts
        $debts = OfficeStock::where('to_office_id', $request->id)
            ->where('balance', '>', 0)
            ->sum('balance');


        //Loop through Office Staff
        foreach ($office->staffs as $staff){
            if($staff->isOnLeave()){
                $staffsOnLeave[] = $staff;
            }
        }

        return view('admin.offices.officeInfo',compact(
            'office',
            'stocks',
            /* 'balance', */
            'staffAbsent',
            'staffsOnLeave',
            'departments',
            'debts',
            'stockCount'));
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
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'emailAddress' => 'required',
                'office_code' => 'required',
                'phone' => 'required',
               // 'phone_number' => 'required',
                'location' => 'required',
                'lga' => 'required',
                'country_id' => 'required',
                'state' => 'required',
                'city_id' => 'required',
                'managerId' => 'required',
                'type'=>'required',
                'officeLevel' => 'required',
		'parentOfficeId' => 'required',
		//newly added
                'region_acronym'=>'required',
		'area_acronym'=>'required',
		'bet_code'=>'required',
                 'bet_id'=>'required ',
                  'branch_report'=>'required',
                 'land_name'=>'required',
                 'land_phone'=>'required',
                'land_email'=>'required',
             'care_name'=>'required',
             'care_phone'=>'required',
             'care_email'=>'required',
              ]);
	    
	    // $officeCode = $request->officeCode;
	    $officeCode = $request->officeCode;
              $name = $request->name;
              $email = $request->email;
            // $office_code = $request->office_code;
             $phone = $request->phone;
             $location = $request->location;
              $countryId = $request->country;
              $stateId = $request->state;
             $cityId = $request->city;
              $managerId = "";
        //$type=$request->officeType;
             $type=$request->type;
              $level =$request->officeLevel;
             $parentOfficeId =$request->officeLevel;
        //newly added
            $regionAcr = $request->region_acronym;
	      $areaAcr = $request->area_acronym;
	      $betcode =$request->bet_code;
        $bet_id = $request->bet_id;
        $branch_report = $request->branch_report;
        $land_name = $request->land_name;
        $land_phone = $request->land_phone;
        $land_email = $request->land_email;
        $care_name =$request->care_name;
        $care_phone = $request->care_phone;
        $care_email =$request ->care_email;


           
           
            $office = new Office ();
                    // dd($request);
                    
                 $office->name = $request->name;
                 $office->emailAddress = $request->email;
                 $office->officeCode = $request->officeCode;
                 $office->phone = $request->phone;
                // $office->phone_number = $request->phone_number;
                 $office->country_id = $request->country_id;
                 $office->city_id = $request->city_id;
                 $office->state_id = $request->state;
                 $office->location = $request->location;
                 $office->lga = $request->lga;
                 $office->managerid = $request->managerid;
                 $office->type = $request->type;
                 $office->level = $request->officeLevel;
                 $office->parentOfficeId = $request->officeLevel;
                 $office->region_acronym = $request->region_acronym;
		 $office->area_acronym = $request->area_acronym;
		 $office->bet_code =$request->bet_code;
		 $office->bet_id = $request->bet_id;
		 $office->branch_report =$request->branch_request;
		 $office->land_name= $request->land_name;
		 $office->land_phone = $request->land_phone;
		 $office->land_email =$request->land_email;
		 $office->care_name = $request->care_name;
		 $office->care_phone=$request->care_phone;
		 $office->care_email=$request->care_email;
    
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


    public function viewStocks(Request $request, $officeId){
        $office = Office::where('id', $officeId)->first();
        $items = OfficeStock::where('to_office_id', $officeId)->get();
        $reasons = Reason::all();
        return view('admin.offices.stock-list', compact('items', 'office', 'reasons'));
    }


    public function acceptStock(Request $request, $officeStockId){
        $stock = OfficeStock::where('id', $officeStockId)->first();
        //Update due date
        $dueDate = Carbon::now()->addWeek($stock->payment_period);
        $stock->status = "approved";
        $stock->due_date = $dueDate;
        $stock->save();

        alert()->success("Successfully accepted Stock", 'Stock Accepted');
        return redirect()->back()->with("message","Successfully accepted Stock");
    }

    public function rejectStock(Request $request, $officeStockId){
        $stock = OfficeStock::where('id', $officeStockId)->first();

        $stock->status = "rejected";
        $stock->reason_id = $request->reason_id;
        $stock->save();

        alert()->success("Successfully rejected Stock", 'Stock Rejected');
        return redirect()->back()->with("message","Successfully accepted Stock");
    }




}
