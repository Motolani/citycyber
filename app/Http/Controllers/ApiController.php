<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use App\User;

class ApiController extends BaseController
{
	//

	public function loadParent(Request $request)
	{
		$offices = new Offices();
		$getParent = $offices->GetAllParents($request->level);
		$dec = (object)$getParent->original;
		// dd($dec);


		return response()->json([
			"status" => $dec->status,
			"data" => $dec->data,
			"message" => $dec->message
		]);
	}

	
	public function getAllOffice(Request $request)
	{
		$offices = new Offices();
		$getParent = $offices->GetAllMyOwnBranches($request->level, $request->id);
		$dec = (object)$getParent->original;
		//dd($dec);

		return response()->json([
			"status" => $dec->status,
			"data" => $dec->data,
			"message" => $dec->message
		]);
	}



	public function getStaffOfficeById($id)
	{
		return User::where("branchId", $id)->get();
	}


	public function getOffences(Request $request)
	{

		$getOffences = \App\Offence::all();
		return response()->json([
			"status" => "200",
			"data" => $getOffences,
		]);

		//return User::where("branchId", $id)->get();
	}



	public function getStaff($branch_id)
	{
		$staff = \App\User::leftJoin('levels', 'levels.id', 'users.level')->where('branchId', $branch_id)->select('users.*', 'levels.title as levelName')->get();
		return response()->json([
			"data" => $staff,
			"status" => "200",
		]);
	}
}
