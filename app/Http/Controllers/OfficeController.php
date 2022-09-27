<?php

namespace App\Http\Controllers;

use App\Office;
use App\Reason;
use App\States;
use App\Countries;
use Carbon\Carbon;
use App\Department;
use App\OfficeStock;
use App\IncidenceOpration;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use App\OfficeLevel;
use Illuminate\Support\Facades\DB;



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
        $getRegion = Office::where('type', 'REGION')->get();
        $getArea = Office::where('type', 'AREA')->get();
        $getHubOne = Office::where('type', 'HUB1')->get();
        $getHubTwo = Office::where('type', 'HUB2')->get();
        $getBranchArea = Office::where('type', 'like', 'BRANCH(AREA)')->get();
        $getBranchHubOne = Office::where('type', 'like', 'BRANCH(HUB1)')->get();
        $getBranchHubTwo = Office::where('type', 'like', 'BRANCH(HUB2)')->get();

        //  $offs = \App\Office::join('officelevels', 'officelevels.level', 'offices.level')
        //          ->select('offices.*', 'officelevels.name as parentLevelName','officelevels.name as parentName','officelevels.level as parentLevel')
        //        ->get();     
        // dd($offs);
        $offs = DB::select(DB::raw("SELECT A.*, officelevels.name AS parentLevelName, B.name AS parentName,B.level AS parentLevel FROM offices A, offices B left join officelevels ON B.level =officelevels.id where A.parentOfficeId = B.id"));
        return view('admin.viewBranches', compact('offs', 'getRegion', 'getArea', 'getHubOne', 'getHubTwo', 'getBranchArea', 'getBranchHubOne', 'getBranchHubTwo'));
    }
    public function getOffice()
    {

        $countries = Countries::all();
        $states = States::all();
        $office = Office::all();
        $getRegion = Office::where('type', 'REGION')->get();
        $getArea = Office::where('type', 'AREA')->get();
        $getHubOne = Office::where('type', 'HUB1')->get();
        $getHubTwo = Office::where('type', 'HUB2')->get();
        $getBranchArea = Office::where('type', 'like', 'BRANCH(AREA)')->get();
        $getBranchHubOne = Office::where('type', 'like', 'BRANCH(HUB1)')->get();
        $getBranchHubTwo = Office::where('type', 'like', 'BRANCH(HUB2)')->get();
        // dd($getBranchArea);
        return view('admin.createoffice', compact('countries', 'states', 'office', 'getRegion', 'getArea', 'getHubOne', 'getHubTwo', 'getBranchArea', 'getBranchHubOne', 'getBranchHubTwo'));
    }



    public function getAllOffice()
    {
        $offices = new Offices();
        $getOffice = $offices->GetAllOffice();

        return view('admin.viewOffices')->with("offices", $getOffice);
    }

    public function getRegion()
    {
        $getRegion = Office::where('type', 'REGION')->get();
        // $getOffice = $offices->GetAllOffice();

        return view('admin.viewRegion')->with("regions", $getRegion);
    }

    public function getArea()
    {
        $getArea = Office::where('type', 'AREA')->get();
        // $getOffice = $offices->GetAllOffice();

        return view('admin.viewArea')->with("areas", $getArea);
    }

    public function getHubOne()
    {
        $getHubOne = Office::where('type', 'HUB1')->get();
        // $getOffice = $offices->GetAllOffice();
        return view('admin.viewHubOne')->with("hubOne", $getHubOne);
    }

    public function getHubTwo()
    {
        $getHubTwo = Office::where('type', 'HUB2')->get();
        // $getOffice = $offices->GetAllOffice();
        return view('admin.viewHubTwo')->with("hubTwo", $getHubTwo);
    }

    public function getBranches()
    {
        $getBranch = Office::where('type', 'like', 'BRANCH%')->get();
        $getRegion = Office::where('type', 'REGION')->get();
        $getArea = Office::where('type', 'AREA')->get();
        $getHubOne = Office::where('type', 'HUB1')->get();
        $getHubTwo = Office::where('type', 'HUB2')->get();
        $office = Office::all();

        // $getOffice = $offices->GetAllOffice();
        // return view('admin.viewBranches')->with("branches",$getBranch);
        return view('admin.viewBranches', compact('getBranch', 'getRegion', 'getArea', 'getHubOne', 'getHubTwo', 'office'));
    }

    public function officeInfo(Request $request)
    {

        $office = Office::where('id', $request->id)
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
        foreach ($office->staffs as $staff) {
            if ($staff->isOnLeave()) {
                $staffsOnLeave[] = $staff;
            }
        }

        return view('admin.offices.officeInfo', compact(
            'office',
            'stocks',
            /* 'balance', */
            'staffAbsent',
            'staffsOnLeave',
            'departments',
            'debts',
            'stockCount'
        ));
    }

    public function updateOffice(Request $request)
    {

        $updateOffice = Office::where('id', $request->id)->update([
            'name' => $request->name, 'emailAddress' => $request->emailAddress, 'phone' => $request->phone,
            'location' => $request->address, 'region_acronym' => $request->region_acronym, 'area_acronym' => $request->area_acronym,
            'bet_code' => $request->bet_code, 'bet_id' => $request->bet_id, 'branch_report' => $request->branch_report, 'care_email' => $request->care_email,
            'land_name' => $request->land_name, 'land_phone' => $request->land_phone, 'land_email' => $request->land_email, 'care_name' => $request->care_name, 'care_phone' => $request->care_phone,

        ]);
        if ($updateOffice) {
            alert()->success("Office info Updated Successfully", 'Success');
            return redirect()->back()->with("message", "Office info Updated Successfully");
        } else {
            alert()->error("Office info could not be updated", 'Success');
            return redirect()->back()->with("message", "Office info could not be updated.");
        }
    }

    public function createStore(Request $request, $officeId)
    {
        $updateOffice = Office::where('id', $officeId)->update(["has_store" => true]);
        if ($updateOffice) {
            alert()->success("Office Store have been created Successfully", 'Success');
            return redirect()->back()->with("message", "Office Store have been created Successfully");
        } else {
            alert()->error("Office Store could not be created", 'Error');
            return redirect()->back()->with("error", "Office Store could not be created");
        }
    }

    public function createOfficeRequest(Request $request)
    {
        //dd($request);
        
        $office = new Office([

            "name" => $request->input('name'),
            "emailAddress" => $request->input('emailAddress'),
            "phone" => $request->input('phone'),
            "phone_number" => $request->input('phone_number'),
            "officeCode" => $request->input('officeCode'),
            "location" => $request->input('location'),
            "country_id" => $request->input('country'),
            "lga" => $request->input('lga'),
            // $office->lga = '';
            "state_id" => $request->input('state'),
            "managerid" => $request->input('managerid'),
            //"officeType" =>$request->input('type'),
            "type" => $request->input('type'),
            "level" => $request->input('level'),
            "officeLevel" =>$request->input('level'),
            "parentOfficeId" => $request->input('parentOfficeId'),
            "region_acronym" => $request->input('region_acronym'),
            "area_acronym" => $request->input('area_acronym'),
            //newly added
            "bet_code" => $request->input('bet_code'),
            "bet_id" => $request->input('bet_id'),
            "branch_report" => $request->input('branch_report'),
            "land_name" => $request->input('land_name'),
            "land_phone" => $request->input('land_phone'),
            "land_email" => $request->input('land_email'),
            "care_name" => $request->input('care_name'),
            "care_phone" => $request->input('care_phone'),
            "care_email" => $request->input('care_email')
            
        ]);

        //dd($office);

        $office->save();
        $insertedId = $office->id;
        $level = $request->level;
        $getPLevel = OfficeLevel::find($level);
        switch ($getPLevel->p) {
            case '1':
                $p4 = 0;
                $p3 = 0;
                $p2 = 0;
                $p1 = $request->parentOfficeId;
                break;
            case '2':
                $p4 = 0;
                $p3 = 0;
                $p1 = $request->parentOfficeId;
                $p2 = Office::where('id', $p1)->first(); //dd($p2);
                DB::table('offices')->where('id', $insertedId)->update(['p2'=>$p2['parentOfficeId'],'p3'=>$p3,'p4'=>$p4]);
                break;
            case '3':
                $p4 = 0;
                $p1 = $request->parentOfficeId;
                $p2 = Office::where('id', $p1)->first(); 
                $p3 = Office::where('id', $p2->parentOfficeId)->first(); 
                DB::table('offices')->where('id', $insertedId)->update(['p2'=>$p2['parentOfficeId'],'p3'=>$p3['parentOfficeId'],'p4'=>$p4]);
                break;
            case '4':
                $p1 = $request->parentOfficeId;
                $p2 = Office::where('id', $p1)->first(); 
                $p3 = Office::where('id', $p2->parentOfficeId)->first(); 
                $p4 = Office::where('id', $p3->parentOfficeId)->first(); 
                DB::table('offices')->where('id', $insertedId)->update(['p2'=>$p2['parentOfficeId'],'p3'=>$p3['parentOfficeId'],'p4'=>$p4['parentOfficeId']]);
                break;
        }
        
        alert()->success("Office Created Successfully", 'Office Created');
        return redirect()->back()->with("status", "Office Created Successfully");

    }


    public function viewStocks(Request $request, $officeId)
    {
        $office = Office::where('id', $officeId)->first();
        $items = OfficeStock::where('to_office_id', $officeId)->get();
        $reasons = Reason::all();
        return view('admin.offices.stock-list', compact('items', 'office', 'reasons'));
    }


    public function acceptStock(Request $request, $officeStockId)
    {
        $stock = OfficeStock::where('id', $officeStockId)->first();
        //Update due date
        $dueDate = Carbon::now()->addWeek($stock->payment_period);
        $stock->status = "approved";
        $stock->due_date = $dueDate;
        $stock->save();

        alert()->success("Successfully accepted Stock", 'Stock Accepted');
        return redirect()->back()->with("message", "Successfully accepted Stock");
    }

    public function rejectStock(Request $request, $officeStockId)
    {
        $stock = OfficeStock::where('id', $officeStockId)->first();

        $stock->status = "rejected";
        $stock->reason_id = $request->reason_id;
        $stock->save();

        alert()->success("Successfully rejected Stock", 'Stock Rejected');
        return redirect()->back()->with("message", "Successfully accepted Stock");
    }
}
