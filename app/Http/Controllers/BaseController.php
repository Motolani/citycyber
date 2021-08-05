<?php
    namespace App\Http\Controllers;

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
        //get all unread incident count.
        $pendingIncidentCount = IncidenceOpration::where('status', 0)->count();
        $pendingAdvanceCount = AdvanceOpration::where('status', 0)->count();
        $pendingBonusCount = BonusOpration::where('status', 0)->count();

        $pendingAllowanceCount = AllowanceOpration::where('status', 0)->count();
        $pendingDeductionCount = DeductionOpration::where('status', 0)->count();
        $pendingLoanCount = LoanOpration::where('status', 0)->count();
    
        $pendingSuspensionCount = SuspensionOpration::where('status', 0)->count();
        $pendingLossDamageCount = BonusOpration::where('status', 0)->count();
    

        View::share('pendingIncidentCount', $pendingIncidentCount);
        View::share('pendingAdvanceCount', $pendingAdvanceCount);
        View::share('pendingBonusCount', $pendingBonusCount);
        View::share('pendingAllowanceCount', $pendingAllowanceCount);
        View::share('pendingDeductionCount', $pendingDeductionCount);
        View::share('pendingLoanCount', $pendingLoanCount);
        View::share('pendingSuspensionCount', $pendingSuspensionCount);
        View::share('pendingLossDamageCount', $pendingLossDamageCount);


    }
    }