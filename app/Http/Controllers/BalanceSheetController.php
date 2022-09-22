<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdvanceOpration;
use App\BalanceSheetHistory;
use App\BonusOpration;
use App\CashAdvanceRequest;
use App\CashierWallet;
use App\CashReserveWallet;
use App\Damages;
use App\Deduction;
use App\DeductionOpration;
use App\Inventory_Store;
use App\Lateness;
use App\LoanOpration;
use App\Offence;
use App\OfficeStock;
use App\PettyCashRequest;
use App\PoolWallet;
use App\ShopWallet;
use App\Win;
use Illuminate\Support\Facades\DB;

class BalanceSheetController extends Controller
{
    public function viewBalanceSheet()
    {

        $currentYear = now()->year;
        $currentMonth = now()->month;

        //liability
        $totalSalaryAdvances = AdvanceOpration::whereYear('created_at',$currentYear)
            ->whereMonth('created_at',$currentMonth)
            ->where('status','approved')
            ->sum('amount');
           
        //liability
        $totalDeductions = DeductionOpration::join('deduction', 'deductionoprations.deduction_id', '=', 'deduction.id')
            ->whereYear('deductionoprations.created_at',$currentYear)
            ->whereMonth('deductionoprations.created_at',$currentMonth)
            ->where('deductionoprations.status','approved')
            ->sum('deduction.amount');
            // ->get();

        //asset
        $totalLoans = LoanOpration::whereYear('created_at',$currentYear)
            ->whereMonth('created_at',$currentMonth)
            ->where('status','approved')
            ->sum('amount');

        //liability
        $totalBonuses = BonusOpration::join('bonus', 'bonusoprations.bonus_id', '=', 'bonus.id')
            ->whereYear('bonusoprations.created_at',$currentYear)
            ->whereMonth('bonusoprations.created_at',$currentMonth)
            ->where('bonusoprations.status','approved')
            ->sum('bonus.amount');

        $totalCashAdvance = CashAdvanceRequest::whereYear('created_at',$currentYear)
            ->whereMonth('created_at',$currentMonth)
            ->where('status','approved')
            ->sum('amount');

        $totalLateness = Lateness::whereYear('created_at',$currentYear)
            ->whereMonth('created_at',$currentMonth)
            ->sum('amount');

        $totalLossDamages = Damages::whereYear('created_at',$currentYear)
            ->whereMonth('created_at',$currentMonth)
            ->where('status','approved')
            ->sum('amount');

        $totalOffences = Offence::whereYear('created_at',$currentYear)
            ->whereMonth('created_at',$currentMonth)
            ->sum('amount');

        $totalOfficeStocks = OfficeStock::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->where('status','approved')
            ->sum('amount_paid');

        $totalPettyCash = PettyCashRequest::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->where('status','approved')
            ->sum('amount');

        $totalPoolWallet = PoolWallet::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('balance');

        $totalCashierWallet = CashierWallet::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('balance');

        $totalCashReserveWallet = CashReserveWallet::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('balance');

        $totalShopWallet = ShopWallet::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('balance');

        $totalWins = Win::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('amount');

        $totalInventoryStore = Inventory_Store::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->where('status','approved')
            ->sum('price');

        $totalAsset =  $totalDeductions + $totalLoans + $totalLateness + $totalLossDamages + $totalOffences + $totalOfficeStocks + $totalPoolWallet + $totalCashReserveWallet + $totalShopWallet;
        
        $totalLiability = $totalSalaryAdvances + $totalBonuses + $totalCashAdvance + $totalPettyCash + $totalCashierWallet + $totalWins + $totalInventoryStore;
        // ->get();

        // $totalAsset = $deductions + $offences + $lossDamages + $lateness + $loans + $cashReserveWallet + $inventoryStore;

        // $totalLiability = $wins + $salaryAdvances + $bonuses + $pettyCash + $cashAdvance;

        // $balanceSheetHistory = new BalanceSheetHistory([
        //     "month_year" => $currentYear . "-" . $currentMonth,
        //     "salary_advance" => $salaryAdvances,
        //     "deductions" => $deductions,
        //     "loans" => $loans,
        //     "bonuses" => $bonuses,
        //     "cash_advance" => $cashAdvance,
        //     "lateness" => $lateness,
        //     "loss_damages" => $lossDamages,
        //     "offences" => $offences,
        //     "office_stocks" => $officeStocks,
        //     "petty_cash" => $pettyCash,
        //     "pool_wallet" => $poolWallet,
        //     "cashier_wallet" => $cashierWallet,
        //     "cash_reserve_wallet" => $cashReserveWallet,
        //     "shop_wallet" => $shopWallet,
        //     "wins" => $wins,
        //     "inventory_store" => $inventoryStore,
        //     // "total_asset" => $totalAsset,
        //     // "total_liability" => $totalLiability
        // ]);
        
        return view('admin.balance-sheet.viewBalanceSheet', 
                    compact('totalSalaryAdvances', 'totalDeductions', 'totalLoans', 'totalBonuses', 'totalCashAdvance', 'totalLateness', 'totalLossDamages', 'totalOffences', 'totalOfficeStocks', 'totalPettyCash', 'totalPoolWallet', 'totalCashierWallet', 'totalCashReserveWallet', 'totalShopWallet', 'totalWins', 'totalInventoryStore', 'totalAsset', 'totalLiability'));
    }

    public function viewBalanceSheetQuery(Request $request)
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


        if(isset($year))
        {
            $totalSalaryAdvances = AdvanceOpration::whereBetween('created_at',[$startDate, $endDate])
            ->where('status','approved')
            ->sum('amount');

            $totalDeductions = DeductionOpration::join('deduction', 'deductionoprations.deduction_id', '=', 'deduction.id')
            ->whereBetween('deductionoprations.created_at',[$startDate, $endDate])
            ->where('deductionoprations.status','approved')
            ->sum('deduction.amount');

            // dd($totalDeductions);
            // ->get();

            //asset
            $totalLoans = LoanOpration::whereBetween('created_at',[$startDate, $endDate])
                ->where('status','approved')
                ->sum('amount');

            //liability
            $totalBonuses = BonusOpration::join('bonus', 'bonusoprations.bonus_id', '=', 'bonus.id')
                ->whereBetween('bonusoprations.created_at',[$startDate, $endDate])
                ->where('bonusoprations.status','approved')
                ->sum('bonus.amount');

            $totalCashAdvance = CashAdvanceRequest::whereBetween('created_at',[$startDate, $endDate])
                ->where('status','approved')
                ->sum('amount');

            $totalLateness = Lateness::whereBetween('created_at',[$startDate, $endDate])
                ->sum('amount');

            $totalLossDamages = Damages::whereBetween('created_at',[$startDate, $endDate])
                ->where('status','approved')
                ->sum('amount');

            $totalOffences = Offence::whereBetween('created_at',[$startDate, $endDate])
                ->sum('amount');

            $totalOfficeStocks = OfficeStock::whereBetween('created_at',[$startDate, $endDate])
                ->where('status','approved')
                ->sum('amount_paid');

            $totalPettyCash = PettyCashRequest::whereBetween('created_at',[$startDate, $endDate])
                ->where('status','approved')
                ->sum('amount');

            $totalPoolWallet = PoolWallet::whereBetween('created_at',[$startDate, $endDate])
                ->sum('balance');

            $totalCashierWallet = CashierWallet::whereBetween('created_at',[$startDate, $endDate])
                ->sum('balance');

            $totalCashReserveWallet = CashReserveWallet::whereBetween('created_at',[$startDate, $endDate])
                ->sum('balance');

            $totalShopWallet = ShopWallet::whereBetween('created_at',[$startDate, $endDate])
                ->sum('balance');

            $totalWins = Win::whereBetween('created_at',[$startDate, $endDate])
                ->sum('amount');

            $totalInventoryStore = Inventory_Store::whereBetween('created_at',[$startDate, $endDate])
                ->where('status','approved')
                ->sum('price');

            $totalAsset =  $totalDeductions + $totalLoans + $totalLateness + $totalLossDamages + $totalOffences + $totalOfficeStocks + $totalPoolWallet + $totalCashReserveWallet + $totalShopWallet;
            
            $totalLiability = $totalSalaryAdvances + $totalBonuses + $totalCashAdvance + $totalPettyCash + $totalCashierWallet + $totalWins + $totalInventoryStore;

            return view('admin.balance-sheet.queryViewBalanceSheet', 
                    compact('endDate', 'startDate','totalSalaryAdvances', 'totalDeductions', 'totalLoans', 'totalBonuses', 'totalCashAdvance', 'totalLateness', 'totalLossDamages', 'totalOffences', 'totalOfficeStocks', 'totalPettyCash', 'totalPoolWallet', 'totalCashierWallet', 'totalCashReserveWallet', 'totalShopWallet', 'totalWins', 'totalInventoryStore', 'totalAsset', 'totalLiability'));
        }
    }

    //Salary Advance Detail
    public function BalanceSheetQueryDetailSalaryAdvances()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $salaryAdvances = AdvanceOpration::whereBetween('created_at',[$startDate, $endDate])
            ->where('status','approved')
            ->get();
        // dd($startDate);

        return view('admin.balance-sheet.advanceDetail', compact('salaryAdvances'));

    }

    public function viewBalanceSheetDetailSalaryAdvances()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $salaryAdvances = AdvanceOpration::whereYear('created_at',$currentYear)
            ->whereMonth('created_at',$currentMonth)
            ->where('status','approved')
            ->get();

            // dd($salaryAdvances);
        return view('admin.balance-sheet.advanceDetail', compact('salaryAdvances'));
    }

    //Inventory Store Detail

    public function BalanceSheetQueryDetailInventoryStore()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $inventoryStore = Inventory_Store::whereBetween('created_at',[$startDate, $endDate])
                ->where('status','approved')
                ->get();
        // dd($startDate);

        return view('admin.balance-sheet.inventoryStore', compact('inventoryStore'));
    }

    public function viewBalanceSheetDetailInventoryStore()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $inventoryStore = Inventory_Store::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->where('status','approved')
            ->get();
            // dd($wins);

        return view('admin.balance-sheet.inventoryStore', compact('inventoryStore'));
    }

    //Shop Wallet Detail
    public function BalanceSheetQueryDetailShopWallet()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $shopWallet = ShopWallet::whereBetween('created_at',[$startDate, $endDate])
                ->get();
        // dd($startDate);

        return view('admin.balance-sheet.shopWallet', compact('shopWallet'));
    }

    public function viewBalanceSheetDetailShopWallet()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $shopWallet = ShopWallet::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->get();
            // dd($wins);

        return view('admin.balance-sheet.shopWallet', compact('shopWallet'));
    }

    //Cash Reserve Wallet Detail
    public function BalanceSheetQueryDetailCashReserveWallet()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $cashReserveWallet = CashReserveWallet::whereBetween('created_at',[$startDate, $endDate])
                ->get();
        // dd($startDate);

        return view('admin.balance-sheet.cashReserveWallet', compact('cashReserveWallet'));
    }

    public function viewBalanceSheetDetailCashReserveWallet()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $cashReserveWallet = CashReserveWallet::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->get();
            // dd($wins);

        return view('admin.balance-sheet.cashReserveWallet', compact('cashReserveWallet'));
    }

    //Cashier Wallet Detail
    public function BalanceSheetQueryDetailCashierWallet()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $cashierWallet = CashierWallet::whereBetween('created_at',[$startDate, $endDate])
            ->get();
        // dd($cashierWallet);

        return view('admin.balance-sheet.cashierWallet', compact('cashierWallet'));

    }

    public function viewBalanceSheetDetailCashierWallet()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $cashierWallet = CashierWallet::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->get();
            // dd($cashierWallet);

        return view('admin.balance-sheet.cashierWallet', compact('cashierWallet'));
    }

    //wins Detail
    public function BalanceSheetQueryDetailWins()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $wins = Win::whereBetween('created_at',[$startDate, $endDate])
            ->get();
        // dd($startDate);

        return view('admin.balance-sheet.winDetail', compact('wins'));

    }

    public function viewBalanceSheetDetailWins()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $wins = Win::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->get();
            // dd($wins);

        return view('admin.balance-sheet.winDetail', compact('wins'));
    }

    //Bonus Detail
    public function BalanceSheetQueryDetailBonuses()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $bonuses = BonusOpration::join('bonus', 'bonusoprations.bonus_id', '=', 'bonus.id')
                ->whereBetween('bonusoprations.created_at',[$startDate, $endDate])
                ->where('bonusoprations.status','approved')
                ->get();
        // dd($startDate);

        return view('admin.balance-sheet.bonusDetail', compact('bonuses'));

    }
    public function viewBalanceSheetDetailBonuses()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $bonuses = BonusOpration::join('bonus', 'bonusoprations.bonus_id', '=', 'bonus.id')
            ->whereYear('bonusoprations.created_at',$currentYear)
            ->whereMonth('bonusoprations.created_at',$currentMonth)
            ->where('bonusoprations.status','approved')
            ->select('bonusoprations.*', 'bonus.*', 'bonusoprations.id as bonusoprations_id')
            ->get();

            // dd($bonuses);
        return view('admin.balance-sheet.bonusDetail', compact('bonuses'));

    }

    //Deduction Details
    public function BalanceSheetQueryDetailDeductions()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $deductions = DeductionOpration::join('deduction', 'deductionoprations.deduction_id', '=', 'deduction.id')
            ->whereBetween('deductionoprations.created_at',[$startDate, $endDate])
            ->where('deductionoprations.status','approved')
            ->get();
        // dd($startDate);

        return view('admin.balance-sheet.deductionDetail', compact('deductions'));
    }

    public function viewBalanceSheetDetailDeductions()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $deductions = DeductionOpration::join('deduction', 'deductionoprations.deduction_id', '=', 'deduction.id')
        ->whereYear('deductionoprations.created_at',$currentYear)
        ->whereMonth('deductionoprations.created_at', $currentMonth)
        ->where('deductionoprations.status','approved')
        ->select('deductionoprations.*', 'deduction.*', 'deductionoprations.id as deductionoprations_id')
        ->get();

        // dd($deductions);
        return view('admin.balance-sheet.deductionDetail', compact('deductions'));

    }

    //Loan Details
    public function BalanceSheetQueryDetailLoans()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $loans = LoanOpration::whereBetween('created_at',[$startDate, $endDate])
                ->where('status','approved')
                ->get();

        // dd($startDate);

        return view('admin.balance-sheet.loanDetail', compact('loans'));
    }

    public function viewBalanceSheetDetailLoans()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $loans = LoanOpration::whereYear('created_at',$currentYear)
            ->whereMonth('created_at',$currentMonth)
            ->where('status','approved')
            ->get();

        // dd($loans);
        return view('admin.balance-sheet.loanDetail', compact('loans'));
    }

    //CashAdvance Detail
    public function BalanceSheetQueryDetailCashAdvance()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $cashAdvances = CashAdvanceRequest::whereBetween('created_at',[$startDate, $endDate])
                ->where('status','approved')
                ->get();

        // dd($startDate);

        return view('admin.balance-sheet.cashAdvanceDetail', compact('cashAdvances'));
    }

    public function viewBalanceSheetDetailCashAdvance()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $cashAdvances = CashAdvanceRequest::whereYear('created_at',$currentYear)
            ->whereMonth('created_at',$currentMonth)
            ->where('status','approved')
            ->get();

        // dd($cashAdvances);
        return view('admin.balance-sheet.cashAdvanceDetail', compact('cashAdvances'));
    }

    //Lateness Detail
    public function BalanceSheetQueryDetailLateness()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $lateness = Lateness::whereBetween('created_at',[$startDate, $endDate])
                ->get();
        // dd($startDate);

        return view('admin.balance-sheet.latenessDetail', compact('lateness'));
    }

    public function viewBalanceSheetDetailLateness()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $lateness = Lateness::whereYear('created_at',$currentYear)
            ->whereMonth('created_at',$currentMonth)
            ->get();

        // dd($lateness);
        return view('admin.balance-sheet.latenessDetail', compact('lateness'));
    }

    //Loss & Damages Detail
    public function BalanceSheetQueryDetailLossDamages()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $lossDamages = Damages::whereBetween('created_at',[$startDate, $endDate])
                ->where('status','approved')
                ->get();
        // dd($startDate);

        return view('admin.balance-sheet.lossDamages', compact('lossDamages'));
    }

    public function viewBalanceSheetDetailLossDamages()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $lossDamages = Damages::whereYear('created_at',$currentYear)
            ->whereMonth('created_at',$currentMonth)
            ->where('status','approved')
            ->get();

        // dd($lossDamages);
        return view('admin.balance-sheet.lossDamages', compact('lossDamages'));
    }

    //offences Detail
    public function BalanceSheetQueryDetailOffences()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $totalOffences = Offence::whereBetween('created_at',[$startDate, $endDate])
                ->get();
        // dd($startDate);

        return view('admin.balance-sheet.offences', compact('offences'));
    }

    public function viewBalanceSheetDetailOffences()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $offences = Offence::whereYear('created_at',$currentYear)
            ->whereMonth('created_at',$currentMonth)
            ->get();

        // dd($offences);
        return view('admin.balance-sheet.offences', compact('offences'));
    }

    //Office Stock Detail
    public function BalanceSheetQueryDetailOfficeStocks()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $officeStocks = OfficeStock::whereBetween('created_at',[$startDate, $endDate])
                ->where('status','approved')
                ->get();
        // dd($startDate);

        return view('admin.balance-sheet.officeStocks', compact('officeStocks'));
    }

    public function viewBalanceSheetDetailOfficeStocks()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $officeStocks = OfficeStock::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->where('status','approved')
            ->get();

        // dd($officeStocks);
        return view('admin.balance-sheet.officeStocks', compact('officeStocks'));
    }

    //Petty Cash Detail
    public function BalanceSheetQueryDetailPettyCash()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $pettyCash = PettyCashRequest::whereBetween('created_at',[$startDate, $endDate])
                ->where('status','approved')
                ->get();
        // dd($startDate);

        return view('admin.balance-sheet.pettyCash', compact('pettyCash'));
    }

    public function viewBalanceSheetDetailPettyCash()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $pettyCash = PettyCashRequest::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->where('status','approved')
            ->get();

        // dd($pettyCash);
        return view('admin.balance-sheet.pettyCash', compact('pettyCash'));
    }

    //poolWallet Detail
    public function BalanceSheetQueryDetailPoolWallet()
    {
        $startDate = session('startDate');
        $endDate = session('endDate');

        $poolWallet = PoolWallet::whereBetween('created_at',[$startDate, $endDate])
                ->get();
        // dd($startDate);

        return view('admin.balance-sheet.poolWallet', compact('poolWallet'));
    }

    public function viewBalanceSheetDetailPoolWallet()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $poolWallet = PoolWallet::whereYear('created_at',$currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->get();

        dd($poolWallet);
        return view('admin.balance-sheet.poolWallet', compact('poolWallet'));
    }
}
