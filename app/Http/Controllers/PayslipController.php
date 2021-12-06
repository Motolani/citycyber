<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Payslip;
use App\BonusOpration;
use App\AllowanceOpration;
use App\DeductionOpration;
use App\OffenceOperation;
use App\AdvanceOpration;
use App\LoanOpration;
use App\User;

class PayslipController extends Controller
{
    public function createstaffpayslip(Request $request){
        $user_id = $request->user_id;
        $users = User::find($user_id);

        $currentYear = now()->year;
        $currentMonth = now()->month;

        $totalStaff = User::where('id', '>', 0)->count();
        $totalPaySlip = Payslip::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        
       

        $bonuses =BonusOpration::with('bonuses')->whereYear('created_at',$currentYear)
                    ->whereMonth('created_at',12)
                    ->where('staff_id', $user_id)
                    ->where('status', 'approved' )
                    ->get();

        $offences = OffenceOperation::with('offences')->whereYear('created_at',$currentYear)
                    ->whereMonth('created_at',12)
                    ->where('staff_id', $user_id)
                    ->where('status', 'approved')
                    ->get();
        $allowances = AllowanceOpration::with('allowances')->whereYear('created_at',$currentYear)
                    ->whereMonth('created_at',07)
                    ->where('staff_id', $user_id)
                    ->where('status', 'approved')
                    ->get();

        $loans = LoanOpration::with('loans')->whereYear('created_at',$currentYear)
                    ->whereMonth('created_at',12)
                    ->where('staff_id', $user_id)
                    ->where('status', 'approved')
                    ->get();
                    
        $deductions=DeductionOpration::with('deductions')->whereYear('created_at',$currentYear)
                    ->whereMonth('created_at',12)
                    ->where('staff_id', $user_id)
                    ->where('status', 'approved')
                    ->get();
        
        $advances=AdvanceOpration::whereYear('created_at',$currentYear)
                    ->whereMonth('created_at',12)
                    ->where('staff_id', $user_id)
                    ->where('status', 'approved')
                    ->get();

        $payslips = Payslip::where('staff_id', $user_id)->get();
        

        // dd($payslips);

        return view("admin.payslip.create_payslip", compact("bonuses", "allowances", "deductions", "offences","advances", "loans", "users", "user_id", "payslips", "totalStaff", "totalPaySlip"));
        
    }

    public function savestaffData(Request $request){
        
        // dd($request);
        $staff_id = $request->user_id;
        $basicSalary= $request->basic_salary;
        $advanceArray =$request->advances;
        $bonusArray=$request->bonuses;
        $deductionArray=$request->deductions;
        $offenceArray=$request->offences;
        $pension=$request->pension;
        $tax=$request->tax;
        $allowance=$request->allowance;
        $loan=$request->loan;
        $netSalary=$request->net_salary;
        
        // //BASIC SALARY
        // if(is_array($levelArray)){
        //     $levels = array_sum($levelArray);
        //     // dd($offences);
        // }else{
        //     // $level = $levelArray;
        // }

        //OFFENCES
        if(is_array($offenceArray)){
            $offences = array_sum($offenceArray);
            // dd($offences);
        }else{
            $offences = $offenceArray;
        }

        //ADVANCE
        if(is_array($advanceArray)){
            $advances = array_sum($advanceArray);
            // dd($advances);
        }else{
            $advances = $advanceArray;
        }

        //BONUS
        if(is_array($bonusArray)){
            $bonuses = array_sum($bonusArray);
        // dd($bonuses);
        }else{
             $bonuses = $bonusArray;
        }
        //DEDUCTION
        if(is_array($deductionArray)){
            $deductions = array_sum($deductionArray);
            // dd($deduction);
        }else{
            $deductions = $deductionArray;
        }

        $createPayslip = new Payslip([
        "basic_salary"=>$basicSalary,
        "advance"=>$advances,
        "allowance"=>$allowance,
        "bonus"=>$bonuses,
        "deduction"=>$deductions,
        "offence"=>$offences,
        "staff_id" => $staff_id,
        "issuer_id" => Auth::id(),
        "pension"=>$pension,
        "tax"=>$tax,
        "loan"=>$loan,
        "net_salary"=>$netSalary,
        ]);

        $createPayslip->save();

        return redirect()->back()->with('message', 'Payslip successfully created ');
    }
    
    public function viewpayroll(Request $request){
        $totalstaff = Payslip::where('id', '>', 0)->count();
        $totalRow = Payslip::all()->count();
        $currentYear = now()->year;
        $currentMonth = now()->month;

            $payRolls = Payslip::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->get();
        return view("admin.payslip.generate_payroll", compact("payRolls"));
    }

    public function viewpayslip(Request $request){
        $payslip= Payslip::all();
        return view("admin.payslip.staff_payslip",compact("payslip"));
    }
}
