<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Rent;
use App\Win;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfitLossController extends Controller
{
    public function profitAndLoss()
    {
        $year = now()->year;
        $month = now()->month;
  
        
        
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $rents = Rent::whereYear('created_at',$currentYear)->whereMonth('created_at', $month)->sum('amount_paid');
        $wins = Win::whereYear('created_at',$currentYear)->where('status', '0')->whereMonth('created_at', $month)->sum('amount');
        $bills = Bill::whereYear('created_at',$currentYear)->whereMonth('created_at', $month)->sum('amount_paid');

        $totalIncome = $wins + 0;
        $totalExpenses = $rents + $bills;

        $profit_or_loss =$totalIncome - $totalExpenses;

        //dd($rents . ',' . $wins. ',' . $bills);
        return view("admin.profit.profitLoss", compact(['rents','wins','bills', 'totalIncome', 'totalExpenses', 'profit_or_loss']));
    }


    public function viewProfitLoss(Request $request)
    {

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


        $rents = Rent::whereYear('created_at',$currentYear)->whereMonth('created_at', '11')->sum('amount_paid');
        $wins = Win::whereYear('created_at',$currentYear)->where('status', '0')->whereMonth('created_at', '11')->sum('amount');
        $bills = Bill::whereYear('created_at',$currentYear)->whereMonth('created_at', '11')->sum('amount_paid');

        


        if(isset($year))
        {
            $rents = Rent::whereBetween('created_at',[$startDate, $endDate])->sum('amount_paid');

            $wins = Win::whereBetween('created_at',[$startDate, $endDate])->sum('amount');

            $bills = Bill::whereBetween('created_at',[$startDate, $endDate])->sum('amount_paid');

            $totalIncome = $wins + 0;
            $totalExpenses = $rents + $bills;

            $profit_or_loss =$totalIncome - $totalExpenses;

            return view("admin.profit.profitLoss", compact(['rents','wins','bills', 'totalIncome', 'totalExpenses', 'profit_or_loss']));
        }
    }

}
