<?php

namespace App\Http\Controllers\ViewControllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Offices;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Core\CreateStaffClass;
use App\Http\Controllers\Core\StaffController;
class Attendance extends Controller
{

    public function attendance(Request $request){
         $request->validate([
            'staff_number' => 'required',
            'actionType' => 'required',
        ]);
        $user = \App\User::where('staff_number',$request->staff_number);
        
        // dd($request);

        if($user->exists()){
            $getUser = $user->first();
            $office = \App\Office::where('id',$getUser->branchId)->first();
            //check attendance to see if he already clocked in before
            $checkAttedance = \App\Attendance::where("staff_number",$request->staff_number)->whereDate("created_at",\Carbon\Carbon::today());
            
            //then check if user wants to clock in
            if($request->actionType == "clockIn"){
                
                if(!$checkAttedance->exists()){
                    $attendance = new \App\Attendance([
                        "staff_id"=>$getUser->id,
                        "staff_number" => $getUser->staff_number,
                        "staff_name"=>$getUser->firstname." ".$getUser->lastname,
                        "office_name"=>$office->name,
                        "office_id"=>$getUser->branchId,
                        // "clockOut"=>"",
                    ]);
                    
                    if($attendance->save()){
                        return redirect()->back()->with("message","Clock in Successful");
                    }else{
                        return redirect()->back()->with("message","Clock in not Successful");
                    }
                }
                else{
                    $getAttencance = $checkAttedance->first();
                    if($getAttencance->status == 1){
                        return redirect()->back()->with("error","You have Already clocked and out for Today");
                    } 
                    else{
                    return redirect()->back()->with("error","You have already Clocked in Today Did you mean to clock out? please select clock out and try again");
                    }
                }

            }else{
                //else he want to clock out the clock out is handled below
                if($checkAttedance->exists()){
                    $userAttendance = $checkAttedance->first();
                    if($userAttendance->status == 1){
                        return redirect()->back()->with("error","You cannot clock out twice in a day.");
                    }else if($userAttendance->status == 0){
                        $userAttendance->status = 1;
                        $userAttendance->clockOut = Carbon::today();
                        if($userAttendance->save()){
                            return redirect()->back()->with("message","You have Successfully Clocked out for today");
                        }else{
                            return redirect()->back()->with("error","Clock out not Successful");
                        }
                    }
                    elseif($userAttendance->status == 1){
                        return redirect()->back()->with("message","You have Already Clacked out for today");
                    }
                    else{
                        return redirect()->back()->with("error","Failed to Clock out Please contact Admin");
                    }
                }else{
                    return redirect()->back()->with("error","You have not clocked in today. please clock in first before clocking out. Thank you");
                }

            }

        }else{
            return redirect()->back()->with("error","Unknown Staff id");
        }
    }
}