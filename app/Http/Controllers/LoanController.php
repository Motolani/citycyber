<?php

namespace App\Http\Controllers;

use App\IncidenceOpration;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;

class LoanController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Add this line to call Parent Constructor from BaseController
        parent::__construct();

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }


    public function homeTest(Request $request)
    {
        dd($request);
    }

    public function viewPendingIncidence(Request $request)
    {
        $incidents = IncidenceOpration::where('status', 'pending')
            ->orWhere('status', 'confirmed')
            ->with('staff')
            ->get();
        return view('admin.loan-list', compact('incidents'));
    }

    public function approve(Request $request)
    {
        $incident = IncidenceOpration::where('id', $request->id)
            ->first();

        //Status 0 - Pending
        //Status 1 - Approved from 1st Admin        
        //Status 2 - Declined by 1st Admin
        //Status 3 - Approved by Super Admin
        //Status 4 - Declined by Super Admin

        //TODO: Check if this is a super admin and update status codes accordingly

        //Check if the incident is valid
        if (isset($incident)) {
            //We assume this is Super Admin for Now
            $incident->status = 'confirmed';
            $incident->save();
        }
        return redirect()->back()->with('success', 'Successfully Approved');
    }


    public function deny(Request $request)
    {
        $incident = IncidenceOpration::where('id', $request->id)
            ->first();

        //Status 0 - Pending
        //Status 1 - Approved from 1st Admin        
        //Status 2 - Declined by 1st Admin
        //Status 3 - Approved by Super Admin
        //Status 4 - Declined by Super Admin

        //TODO: Check if this is a super admin and update status codes accordingly

        //Check if the incident is valid
        if (isset($incident)) {
            //We assume this is Super Admin for Now
            $incident->status = 'cancelled';;
            $incident->save();
        }
        return redirect()->back()->with('success', 'Successfully Denied');
    }


    public function bulkAction(Request $request)
    {
        $items = $request->items;
        $action = $request->action;

        //Status 0 - Pending
        //Status 1 - Approved from 1st Admin        
        //Status 2 - Declined by 1st Admin
        //Status 3 - Approved by Super Admin
        //Status 4 - Declined by Super Admin

        if ($action == "accept")
            $status = 'approved';
        else
            $status = 'disapproved';

        //TODO: Check if this is a super admin and update status codes accordingly
        $incident = IncidenceOpration::whereIn('id', $items)->update(['status' => $status]);

        return redirect()->back()->with('success', 'The User has been ' . $status);
    }
}
