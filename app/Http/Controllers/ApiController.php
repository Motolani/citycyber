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
	   $dec = (object)$getParent->original;
		// dd($dec);
	   

	   

	   return response()->json([
		"status"=>$dec->status,
		"data"=>$dec->data,
		"message"=>$dec->message
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



	public function getStaff($branch_id)
	{
		$staff = \App\User::where('branchId',$branch_id)->get();
		return response()->json([
			"data"=>$staff,
			"status"=>"200",
		]);
	}
}
