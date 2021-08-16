<?php
namespace App\Http\Controllers;

use App\PettyCashRequest;
use Illuminate\Http\Request;
use App\Controllers\Core\Offices;
use App\IncidenceOpration;
use App\AdvanceOpration;
use App\BonusOpration;
use App\AllowanceOpration;
use App\DeductionOpration;
use App\LoanOpration;
use App\SuspensionOpration;
use App\User;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    //

    public function __construct()
    {
        //TODO: If User is SuperAdmin, Select pending, confirmed

        //get all unread incident count.
        $pendingLoanCount = LoanOpration::where('status', 'pending')->count();
        $pendingBonusCount = BonusOpration::where('status', 'pending')->count();
        $pendingAdvanceCount = AdvanceOpration::where('status', 'pending')->count();
        $pendingLossDamageCount = BonusOpration::where('status', 'pending')->count();
        $pendingIncidentCount = IncidenceOpration::where('status', 'pending')->count();
        $pendingDeductionCount = DeductionOpration::where('status', 'pending')->count();
        $pendingAllowanceCount = AllowanceOpration::where('status', 'pending')->count();
        $pendingSuspensionCount = SuspensionOpration::where('status', 'pending')->count();
        $pendingPettyCashCount = PettyCashRequest::where('status', 'pending')->count();


        View::share('pendingLoanCount', $pendingLoanCount);
        View::share('pendingBonusCount', $pendingBonusCount);
        View::share('pendingAdvanceCount', $pendingAdvanceCount);
        View::share('pendingIncidentCount', $pendingIncidentCount);
        View::share('pendingPettyCashCount', $pendingPettyCashCount);
        View::share('pendingDeductionCount', $pendingDeductionCount);
        View::share('pendingAllowanceCount', $pendingAllowanceCount);
        View::share('pendingSuspensionCount', $pendingSuspensionCount);
        View::share('pendingLossDamageCount', $pendingLossDamageCount);


    }
}