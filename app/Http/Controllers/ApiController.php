<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use App\User; 

class ApiController extends BaseController
{
    //

	public function loadParent(Request $request){
	   $offices = new Offices();
	   $getParent = $offices->GetAllParents($request->level);
	   return response()->json([
		"status"=>"200",
		"data"=>$getParent,
	   ]);
	}

	public function getStaffOfficeById($id){
        	return User::where("branchId", $id)->get();
    	}


	public function getOffences(Request $request){
           
	   $getOffences = \App\Offence::all();
	   return response()->json([
              "status"=>"200",
              "data"=>$getOffences,
           ]);

		//return User::where("branchId", $id)->get();
        }
}
