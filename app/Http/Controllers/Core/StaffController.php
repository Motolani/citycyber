<?php
namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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
//use App\Class;
use App\Education;
use App\NextOfKin;
use App\EmergencyContact;
use App\User;

class StaffController extends Controller 
{

    public function __construct(){

    }



    public function CreateStaff($data){
        $staff = new Staff();
        $staff->save($data);

        return $staff;
    }

    public function ViewAllStaff(){
        $staff = Staff::all();
        
        return $staff;
    }

    public function EditStaff($id, $data){
        $staff = Staff::find($id);
        $staff->update($data);

        return $staff;
    }

    public function UpdateStaffProperty($id, $property, $propertyId = null, $data){
        switch ($property) {
            case 'status':
                return $this->userUpdate($id, $data);
                break;
            case 'staffBankAcc':
                return StaffBankAcc::where("userId", $id)->where("id", $propertyId)->update($data);
                break;
            case 'guarantors':
                return Guarantor::where("userId", $id)->where("id", $propertyId)->update($data);
                break;
            case 'docStorage':
                return DocStorage::where("userId", $id)->where("id", $propertyId)->update($data);
                break;
            case 'educations':
                return Education::where("userId", $id)->where("id", $propertyId)->update($data);
                break;
            case 'nextOfKins':
                return NextOfKin::where("userid", $id)->where("id", $propertyId)->update($data);
                break;
            case 'emergencyContact':
                return EmergencyContact::where("userid", $id)->where("id", $propertyId)->update($data);
                break;
            case 'unit':
                return $this->userUpdate($id, $data);
                break;
            case 'branchId':
                return $this->userUpdate($id, $data);
                break;
            case 'department':
                return $this->userUpdate($id, $data);
                break;
            case 'departmentRole':
                return $this->userUpdate($id, $data);
                break;
            case 'level':
                return $this->userUpdate($id, $data);
                break;
            case 'position':
                return $this->userUpdate($id, $data);
                break;
            case 'resumptionType':
                return $this->userUpdate($id, $data);
                break;
            case 'imgUrl':
                return $this->userUpdate($id, $data);
                break;
            case 'workExperiences':
                return WorkExperience::where("userid", $id)->where("id", $propertyId)->update($data);
                break;
            case 'educations':
                return Education::where("userid", $id)->where("id", $propertyId)->update($data);
                break;                            
        }

        return json_encode([
            "error" => "Property does not exist!."
        ]);
    }

    function userUpdate($id, $data){
        return User::where("id", $id)->update($data);
    }
/*	
    function getStaffOfficeById($officeid){
	return User::where("branchId", $officeid)->get();
    }
*/

}

?>

