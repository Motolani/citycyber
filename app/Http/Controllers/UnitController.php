<?php
namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use App\Bonus;
use App\BonusOpration;
use App\Level;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SweetAlert;

class UnitController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }


    //crud for Unit Starts
    public function createUnit(Request $request){
        if(isset($request->submit) && $request->submit == "createUnit"){

            $unit = \App\Unit::where('title',$request->title)->exists();

            if($unit){
                alert()->success("Unit already exists", 'Success');
                return redirect()->with("message","Unit Already Exists");
            }

            $create = new \App\Unit([

                "title"=>$request->name,
            ]);
            if($create->save()){

                // return response()->json([
                //     "status"=> "200",
                //     "message"=>"Saved Successfully"
                // ]);

                return redirect()->back()->with("message","Unit Created Successfully");
            }
        }else{

            return view('admin.staff.data.createUnit');
        }


    }


    public function viewUnit(Request $request){
        $units = \App\Unit::all();
        return view('admin.staff.data.viewUnit',compact('units'));

    }


    public function viewEditUnit(Request $request, $unitId){
        $unit = Unit::where('id', $unitId)->first();
        return view('admin.unit.edit-unit',compact('unit'));

    }


    public function updateUnit(Request $request){
        $unit = Unit::where('id',$request->id)->update(["title"=>$request->name]);

        alert()->success("Unit Edited Successfully", 'Success');
        return redirect()->back();
        return view('admin.staff.level.viewLevel',compact('message'));
    }


    public function deleteUnit(Request $request, $id){

        $unit = Unit::where('id', $id)->delete();
        if($unit){
            alert()->success("Unit Deleted Successfully", 'Success');
            return redirect()->back();
        }
    }

}

