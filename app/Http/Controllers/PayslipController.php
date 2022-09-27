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
use App\Level;
use App\LoanOpration;
use App\User;
use Illuminate\Support\Facades\Response;

class PayslipController extends Controller
{
    public function createstaffpayslip(Request $request){
        $user_id = $request->user_id;
        $users = User::find($user_id);
        //dd($users->level);

        $currentYear = now()->year;
        $currentMonth = now()->month;

        $totalStaff = User::where('id', '>', 0)->count();
        $totalPaySlip = Payslip::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        
       

        $bonuses =BonusOpration::with('bonuses')->whereYear('created_at',$currentYear)
                    ->whereMonth('created_at',$currentMonth)
                    ->where('staff_id', $user_id)
                    ->where('status', 'approved' )
                    ->get();

        $offences = OffenceOperation::with('offences')->whereYear('created_at',$currentYear)
                    ->whereMonth('created_at',$currentMonth)
                    ->where('staff_id', $user_id)
                    ->where('status', 'approved')
                    ->get();
        $allowances = AllowanceOpration::with('allowances')->whereYear('created_at',$currentYear)
                    ->whereMonth('created_at',$currentMonth)
                    ->where('staff_id', $user_id)
                    ->where('status', 'approved')
                    ->get();

        $loans = LoanOpration::with('loans')->whereYear('created_at',$currentYear)
                    ->whereMonth('created_at',$currentMonth)
                    ->where('staff_id', $user_id)
                    ->where('status', 'approved')
                    ->get();
                    
        $deductions=DeductionOpration::with('deductions')->whereYear('created_at',$currentYear)
                    ->whereMonth('created_at',$currentMonth)
                    ->where('staff_id', $user_id)
                    ->where('status', 'approved')
                    ->get();
        
        $advances=AdvanceOpration::whereYear('created_at',$currentYear)
                    ->whereMonth('created_at',$currentMonth)
                    ->where('staff_id', $user_id)
                    ->where('status', 'approved')
                    ->get();

        $payslips = Payslip::where('staff_id', $user_id)->get();

        $staffSalary = Level::where('title', $users->level)->get();
        //dd($staffSalary[0]->salary);
        

        // dd($payslips);

        return view("admin.payslip.create_payslip", compact("bonuses", "allowances", "deductions", "offences","advances", "loans", "users", "user_id", "payslips", "totalStaff", "totalPaySlip", "staffSalary"));
        
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

        $credit = $basicSalary + $advances + $allowance + $bonuses;
        //dd($credit);
        $debit = $deductions + $offences +$pension + $tax + $loan;
        $netSalary = $credit - $debit;
        //dd($netSalary);

        $currentMonth = now()->month;
        
        $checkStaff = Payslip::where('staff_id')->whereMonth('created_at',$currentMonth)->exists();
        //dd($checkStaff);
        if(!$checkStaff){

            $createPayslip = new Payslip([
                "basic_salary"=>$basicSalary,
                "advance"=> $advances != null ? $advances : 0 ,
                "allowance"=>$allowance != null ? $allowance : 0,
                "bonus"=>$bonuses != null ? $bonuses : 0,
                "deduction"=>$deductions != null ? $deductions : 0,
                "offence"=>$offences != null ? $offences : 0,
                "staff_id" => $staff_id,
                "issuer_id" => Auth::id(),
                "pension"=>$pension,
                "tax"=>$tax,
                "loan"=>$loan != null ? $loan : 0,
                "net_salary"=>$netSalary,
            ]);

        }else{
            alert()->error('Staff Payslip Record has already been created', '');
            return redirect()->back()->with('message', 'Staff Payslip Record has already been created');
        }
        

        $createPayslip->save();

        return redirect('/viewpayslip')->with('message', 'Payslip successfully created ');
    }
    
    public function viewpayroll(Request $request){
        $totalstaff = Payslip::where('id', '>', 0)->count();
        $totalRow = Payslip::all()->count();
        $currentYear = now()->year;
        $currentMonth = now()->month;

           

        $payRolls = Payslip::join('users', 'users.id', 'payslips.staff_id')->select(['payslips.*', 'users.firstname as firstname', 'users.lastname as lastname'])
                ->whereMonth('payslips.created_at', $currentMonth)
                ->get();
        //dd($payRolls);

        $totalPayslip = count($payRolls);
        return view("admin.payslip.generate_payroll", compact("payRolls", "totalstaff", "totalPayslip"));
    }

    public function viewpayslip(Request $request){
        $payslip= Payslip::all();
        return view("admin.payslip.staff_payslip",compact("payslip"));
    }

    public function viewallpayslip()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $payslip= Payslip::whereMonth('created_at', $currentMonth)->orderBy('id', 'DESC')->get();
        $payRolls = Payslip::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->get();
        $totalPayslip = count($payRolls);
        //dd($payslip);
        return view("admin.payslip.viewPayslip",compact("payslip", "totalPayslip"));
    }

    public function viewQueriedPayroll(Request $request)
    {
        $totalstaff = Payslip::where('id', '>', 0)->count();

        $request->validate([
            'year' => 'required|min:4|max:4',
        ]);

        $currentYear = now()->year;
        $currentMonth = now()->month;

        $start = $request->from;
        $end = $request->to;
        $year = $request->year;

        $startDate = date($year . '-' . $start . '-01');
        $endDate = date($year . '-' . $end . '-31');

        $request->session()->put('startDate', date($year . '-' . $start . '-01'));
        $request->session()->put('endDate', date($year . '-' . $end . '-31'));

        $payRolls = Payslip::join('users', 'users.id', 'payslips.staff_id')
                    ->select(['payslips.*', 'users.firstname as firstname', 'users.lastname as lastname'])
                    ->whereMonth('payslips.created_at', $currentMonth)
                    ->get();

        if(isset($year))
        {

            $payRolls = Payslip::join('users', 'users.id', 'payslips.staff_id')
                        ->select(['payslips.*', 'users.firstname as firstname', 'users.lastname as lastname'])
                        ->whereBetween('payslips.created_at', [$startDate, $endDate])->get();

            $filename = "payslip_info.csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, [
                'Date',
                'Basic Salary',
                'Advance',
                'Allowance',
                'Bonus',
                'Deduction',
                'Offence',
                'Pension',
                'Tax',
                'Loan',
                'Net Salary'
            ]);
            foreach ($payRolls as $pay) {
                fputcsv($handle, [
                    $pay->created_at,
                    $pay->basic_salary,
                    $pay->advance,
                    $pay->allowance,
                    $pay->bonus,
                    $pay->deduction,
                    $pay->offence,
                    $pay->pension,
                    $pay->tax,
                    $pay->loan,
                    $pay->net_salary,
                ]);
            }
            
            fclose($handle);

            $headers = array(
                'Content-Type' => 'text/csv',
            );
            return Response::download($filename, 'payslip.csv', $headers);

            return view("admin.payslip.generate_payroll", compact("payRolls", "totalstaff"));
        }
    }

    public function destroyPayslip($id)
    {
        $payslip = Payslip::find($id);
        //dd($rec);
        $payslip->delete();
        
        alert()->success('Payslip Deleted succesfully', '');
        return redirect()->back()->with("success","Payslip Deleted succesfully");
    }
}
