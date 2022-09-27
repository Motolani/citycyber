<?php

namespace App\Http\Controllers;

use App\Environment;
use App\EnvironmentalPaymentHistory;
use App\Office;
use App\Rent;
use App\RentHistory;
use App\Security;
use App\SecurityPaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RentController extends Controller
{
    public function createRentForm()
    {
        $offices = Office::all();

        return view("admin.rent.createRent", compact('offices'));

    }

    public function createRent(Request $request)
    {
        //dd($request->office_name);
        $validatedData = $request->validate([
            'office_name' => 'required',
            'office_address' => 'required',
            'phone_number' => 'required',
            'amount_paid' => 'required',
            'tenure' => 'required',
            'date_paid' => 'required',
            'landlord_name' => 'required',
            'landlord_address' => 'required',
            'landlord_phone' => 'required',
            'landlord_email' => 'required',
        ]);
        

        $rent = new Rent();
        
        $rent->office_name = $request->office_name;
        $rent->office_address = $request->office_address;
        $rent->phone_number = $request->phone_number;
        $rent->amount_paid = $request->amount_paid;
        $rent->rent_type = $request->rent_type;
        $rent->tenure = $request->tenure;
        $rent->duration = $request->duration;
        $rent->date_paid = $request->date_paid;
        $rent->renewal_date = $request->renewal_date;
        $rent->landlord_name = $request->landlord_name;
        $rent->landlord_address = $request->landlord_address;
        $rent->landlord_phone = $request->landlord_phone;
        $rent->landlord_email = $request->landlord_email;

        $rent->save();

        if($rent){

            $offices = Office::where('rent_id', $rent->id)->get();

            $rent_history = new RentHistory();

            $rent_history->rent_id = $rent->id;
            $rent_history->type = $rent->rent_type;
            $rent_history->amount_paid = $rent->amount_paid;
            $rent_history->offices_id = $rent->office_name;
            $rent_history->date_paid = $rent->date_paid;
            $rent_history->renewal_date = $rent->renewal_date;
            $rent_history->duration = $rent->duration;
            $rent_history->landlord_name = $rent->landlord_name;

            $rent_history->save();

            alert()->success('Rent created succesfully', '');
            return redirect()->back()->with("success","Rent created succesfully");
        }
    }


    public function viewRentPayment()
    {
        //$rents =RentHistory::with("offices")->get();
        $rents = RentHistory::join('offices', 'offices.id', 'rent_payment_histories.offices_id')
            ->get(['rent_payment_histories.*', 'offices.name as offices']);
      
        return view("admin.rent.viewRentHistory", compact('rents'));
    }

    public function editRentForm($id)
    {
        $rent = RentHistory::find($id);
        $rec = Rent::where('id', $rent->rent_id)->first();
        //dd($rec->id);
        return view("admin.rent.editRent", compact('rec'));
    }

    public function updateRent(Request $request, $id)
    {
        $validatedData = $request->validate([
            'office_name' => 'required',
            'office_address' => 'required',
            'phone_number' => 'required',
            'amount_paid' => 'required',
            'tenure' => 'required',
            'date_paid' => 'required',
            'landlord_name' => 'required',
            'landlord_address' => 'required',
            'landlord_phone' => 'required',
            'landlord_email' => 'required',
        ]);
        //dd($id);
        $rent = Rent::find($id);

        $rent->office_name = $request->office_name;
        $rent->office_address = $request->office_address;
        $rent->phone_number = $request->phone_number;
        $rent->amount_paid = $request->amount_paid;
        $rent->rent_type = $request->rent_type;
        $rent->tenure = $request->tenure;
        $rent->duration = $request->duration;
        $rent->date_paid = $request->date_paid;
        $rent->renewal_date = $request->renewal_date;
        $rent->landlord_name = $request->landlord_name;
        $rent->landlord_address = $request->landlord_address;
        $rent->landlord_phone = $request->landlord_phone;
        $rent->landlord_email = $request->landlord_email;

        $rent->save();

        if($rent){

            $offices = Office::where('rent_id', $rent->id)->first();
            //dd($offices->name);
            //dd($rent->id);
            $rent_history = RentHistory::find($rent->id);
            //dd($rent->id);
            $rent_history->rent_id = $offices->rent_id;
            dd($rent->id);
            $rent_history->type = $rent->rent_type;
            $rent_history->amount_paid = $rent->amount_paid;
            //$rent_history->offices = $offices->id;
            $rent_history->date_paid = $rent->date_paid;
            $rent_history->renewal_date = $rent->renewal_date;
            $rent_history->duration = $rent->duration;
            $rent_history->landlord_name = $rent->landlord_name;

            $rent_history->save();

            alert()->success('Rent Updated succesfully', '');
            return redirect()->back()->with("success","Rent Updated succesfully");
        }
    }

    public function deleteRent($id)
    {
        $rent = RentHistory::find($id);
        //dd($rent);
        $rec = Rent::where('id', $rent->rent_id)->first();
        //dd($rec);
        $rec->delete();

        if($rec){
            $rent->delete();

            alert()->success('Rent Deleted succesfully', '');
            return redirect()->back()->with("success","Rent Deleted succesfully");
        }

        
    }

    public function createSecurityForm()
    {
        $offices = Office::all();
        return view("admin.rent.createSecurity", compact('offices'));

    }


    public function createSecurity(Request $request)
    {
        $validatedData = $request->validate([
            'office_name' => 'required',
            'office_address' => 'required',
            'phone_number' => 'required',
            'amount_paid' => 'required',
            'tenure' => 'required',
            'duration' => 'required',
            'date_paid' => 'required',
            'renewal_date' => 'required',
        ]);
        

        $sec = new Security();
        
        $sec->office_name = $request->office_name;
        $sec->office_address = $request->office_address;
        $sec->phone_number = $request->phone_number;
        $sec->amount_paid = $request->amount_paid;
        $sec->tenure = $request->tenure;
        $sec->duration = $request->duration;
        $sec->date_paid = $request->date_paid;
        $sec->renewal_date = $request->renewal_date;

        $sec->save();

        if($sec){

            $offices = Office::where('security_id', $sec->id)->get();

            $sec_history = new SecurityPaymentHistory();

            $sec_history->security_id = $sec->id;
            //$sec_history->type = 'security';
            $sec_history->amount_paid = $sec->amount_paid;
            //$sec_history->offices = $offices->name;
            $sec_history->date_paid = $sec->date_paid;
            $sec_history->renewal_date = $sec->renewal_date;
            $sec_history->duration = $sec->duration;

            $sec_history->save();

            alert()->success('Security Bill created Succesfully', '');
            return redirect()->back()->with("success","Security Bill created Succesfully");
        }
    }

    public function viewSecurity()
    {   
        $securities = SecurityPaymentHistory::with("offices")->get();
        /* $securities = Security::join('offices', 'offices.security_id', 'securities.id')
            ->get(['securities.*', 'offices.name as offices']); */

        //dd($securities);
        //return response()->json(SecurityPaymentHistory::with("offices")->get());

        return view("admin.rent.viewSecurity", compact('securities'));
    }

    public function createEnvForm()
    {
        $offices = Office::all();
        return view("admin.rent.createEnv", compact('offices'));

    }

    public function createEnv(Request $request)
    {
        $validatedData = $request->validate([
            'office_name' => 'required',
            'office_address' => 'required',
            'phone_number' => 'required',
            'amount_paid' => 'required',
            'tenure' => 'required',
            'duration' => 'required',
            'date_paid' => 'required',
            'renewal_date' => 'required',
        ]);
        

        $envmt = new Environment();
        
        $envmt->office_name = $request->office_name;
        $envmt->office_address = $request->office_address;
        $envmt->phone_number = $request->phone_number;
        $envmt->amount_paid = $request->amount_paid;
        $envmt->tenure = $request->tenure;
        $envmt->duration = $request->duration;
        $envmt->date_paid = $request->date_paid;
        $envmt->renewal_date = $request->renewal_date;

        $envmt->save();
        //dd($rent->id);
        if($envmt){

            $offices = Office::where('environment_id', $envmt->id)->first();
            //dd($offices);

            $envt_history = new EnvironmentalPaymentHistory();

            $envt_history->environment_id = $envmt->id;
            //$envt_history->type = 'Environmental Bill';
            $envt_history->amount_paid = $envmt->amount_paid;
            //$envt_history->offices = $offices->id;
            $envt_history->date_paid = $envmt->date_paid;
            $envt_history->renewal_date = $envmt->renewal_date;
            $envt_history->duration = $envmt->duration;

            $envt_history->save();

            alert()->success('Environmental Bill created succesfully', '');
            return redirect()->back()->with("success","Environmental Bill created succesfully");
        }
    }

    public function viewEnv()
    {
        $environments = EnvironmentalPaymentHistory::with("offices")->get();
        return view("admin.rent.viewEnv", compact('environments'));
    }

}
