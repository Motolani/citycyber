<?php
namespace App\Http\Controllers\Core;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Office;
use App\OfficeLevel;

class Offices extends Controller
{

    public function __construct(){

    }

    public function CreateOffice($data){
	//dd($data);
        $exist = Office::where("name", $data->name)->exists();
        if($exist) {return "Duplicate name error.";}




    }

    public function GetAllOffice(){
        return Office::all();
    }

    public function GetAllLevels($office = true){
        if($office)
            return OfficeLevel::all();
        else{
            return OfficeLevel::where('id', '!=', 1)->get();
        }
    }

    public function GetAllParents($level){
        $offices = [];

        switch ($level) {
            case 1:
                $offices = Office::leftJoin('officelevels', 'offices.level', 'officelevels.level')->select('offices.*', 'officelevels.name as office_level_name')->where("Offices.level", 1)->get();
                break;
            case 2:
                $offices = Office::leftJoin('officelevels', 'offices.level', 'officelevels.level')->select('offices.*', 'officelevels.name as office_level_name')->where("Offices.level", 1)->get();
                break;
            case 3:
                $offices = Office::leftJoin('officelevels', 'offices.level', 'officelevels.level')->select('offices.*', 'officelevels.name as office_level_name')->where("Offices.level", 2)->get();
                break;
            case 4:
                $offices = Office::leftJoin('officelevels', 'offices.level', 'officelevels.level')->select('offices.*', 'officelevels.name as office_level_name')->where("Offices.level", 2)->get();
                break;
            case 5:
                $offices = Office::leftJoin('officelevels', 'offices.level', 'officelevels.level')->select('offices.*', 'officelevels.name as office_level_name')->where("Offices.level", 3)->get();
                break;  
            case 6:
                $offices = Office::leftJoin('officelevels', 'offices.level', 'officelevels.level')->select('offices.*', 'officelevels.name as office_level_name')->where("Offices.level", 3)->get();
                break;  
            case 7:
                $offices = Office::leftJoin('officelevels', 'offices.level', 'officelevels.level')->select('offices.*', 'officelevels.name as office_level_name')->where("Offices.level", 5)->get();
                break;
            case 8:
                $offices = Office::leftJoin('officelevels', 'offices.level', 'officelevels.level')->select('offices.*', 'officelevels.name as office_level_name')->where("Offices.level", 4)->get();
                break;              
        }
        //dd($offices);
        if(sizeof($offices) > 0){ 
            return response()->json([
            "status" => "200",
            "data" => $offices,
            "message" => "Offices Retrieved Successfully"
            ]);
        }

            return response()->json([
            "status" => "300",
            "data" => [],
            "message" => "No parent for the selected level."
        ]);
    }

    public function availableBranchesForSwitch($id){
        $parentLevels = [];
        $office = Office::where("id", $id)->first();
        
        $level = $office->level;
        switch ($level) {
            case 8:
                $parentLevels = [4,3,5];
                break;
            case 6:
                $parentLevels = [4,3,5];
                break;
            case 7:
                $parentLevels = [4,3,5];
                break;
            case 5:
                $parentLevels = [3,2];
                break;
            case 4:
                $parentLevels = [3,2];
                break;
        }

        return $parentLevels;
    }

    public function switchBranch($id, $newlevel, $parentLevel){
        $parentId = Office::where("level", $parentLevel)->first()->id;
        return $update = Office::where("id", $id)->update([
            "parentOfficeId" => $parentId,
            "level" => $newlevel
        ]);
    }

    public function GetOfficeLevel($id){
        return Office::select("id,level")->where("id", $id)->get();
    }

    public function UpdateOffice($id, $data){
        $exist = Office::where("name", $data->name)->get();
        if($exist) return "Duplicate name error.";

        return Office::where('id', $id)->update($data);
    }

    public function DeleteOffice($id){
        $exist = Office::find($id);
        if(!$exist) return "Office does not exist error";

        return $exist->update(["status" => 1]);
    }

    public function GetOfficeByLevel($level){
        $office = Office::where("level", $level)->get();

        return $office;
    }

    public function GetChildrenOffice($level){
        $offices = [];

        switch ($level) {
            case 3:
                $offices = Office::where("level", 6)->get();
                break;
            case 4:
                $offices = Office::where("level", 8)->get();
                break;
            case 5:
                $offices = Office::where("level", 7)->get();
                break;                      
        }

        return $offices;
    }

    public function GetAllBranches($level)
    {
        $offices = [];

        switch ($level) {
            case 1:
                $offices = Office::where('level', $level)->get();
                break;
            case 2:
                $offices = Office::where('level', $level)->get();
                break;
            case 3:
                $offices = Office::where('level', $level)->get();
                break;
            case 4:
                $offices = Office::where('level', $level)->get();
                break;
            case 5:
                $offices = Office::where('level', $level)->get();
                break;  
            case 6:
                $offices = Office::where('level', $level)->get();
                break;  
            case 7:
                $offices = Office::where('level', $level)->get();
                break;
            case 8:
                $offices = Office::where('level', $level)->get();
                break;              
        }
        //dd($offices);
        if(sizeof($offices) > 0){ 
            return response()->json([
            "status" => "200",
            "data" => $offices,
            "message" => "Offices Retrieved Successfully"
            ]);
        }

            return response()->json([
            "status" => "300",
            "data" => [],
            "message" => "No parent for the selected level."
        ]);
    }

}

?>

