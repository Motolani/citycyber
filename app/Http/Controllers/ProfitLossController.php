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
    public function profitAndLoss(Request $request)
    {
        $start = $request->from;
        $end = $request->to;
        $year = $request->year;
  
        $rents = Rent::whereYear('created_at',$year)
                        ->whereBetween('created_at', [$start, $end])
                        ->sum('amount_paid');
        //dd($rents);
        
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $rents = Rent::whereYear('created_at',$currentYear)->whereMonth('created_at', '11')->sum('amount_paid');
        $wins = Win::whereYear('created_at',$currentYear)->where('status', '0')->whereMonth('created_at', '11')->sum('amount');
        $bills = Bill::whereYear('created_at',$currentYear)->whereMonth('created_at', '11')->sum('amount_paid');

        $totalIncome = $wins + 0;
        $totalExpenses = $rents + $bills;

        $profit_or_loss =$totalIncome - $totalExpenses;

        //dd($rents . ',' . $wins. ',' . $bills);
        return view("admin.profit.profitloss", compact(['rents','wins','bills', 'totalIncome', 'totalExpenses', 'profit_or_loss']));
    }
}
