<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillHistory;
use App\Environment;
use App\EnvironmentalPaymentHistory;
use App\Office;
use App\RealEstate;
use App\Rent;
use App\RentHistory;
use App\Security;
use App\SecurityPaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RentController extends Controller
{
    /* Rent Starts */
    
    public function createRentForm()
    {
        $offices = Office::all();
        $reals = RealEstate::all();

        return view("admin.rent.createRent", compact('offices', 'reals'));

    }

    public function createRent(Request $request)
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
            $rent_history = RentHistory::find($rent->id);
            $rent_history->rent_id = $offices->rent_id;
            //dd($rent->id);
            $rent_history->type = $rent->rent_type;
            $rent_history->amount_paid = $rent->amount_paid;
            $rent_history->offices_id = $rent->office_name;
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

    /* Rent Ends */


    /* Bills Starts */

    public function createBillForm()
    {
        $offices = Office::all();
        return view("admin.rent.createBills", compact('offices'));

    }


    public function createBill(Request $request)
    {
        $validatedData = $request->validate([
            'office_name' => 'required',
            'office_address' => 'required',
            'phone_number' => 'required',
            'amount_paid' => 'required',
            'bill_type' => 'required',
            'tenure' => 'required',
            'duration' => 'required',
            'date_paid' => 'required',
            'renewal_date' => 'required',
        ]);
        

        $bill = new Bill();
        
        $bill->office_name = $request->office_name;
        $bill->office_address = $request->office_address;
        $bill->phone_number = $request->phone_number;
        $bill->amount_paid = $request->amount_paid;
        $bill->bill_type = $request->bill_type;
        $bill->tenure = $request->tenure;
        $bill->duration = $request->duration;
        $bill->date_paid = $request->date_paid;
        $bill->renewal_date = $request->renewal_date;

        $bill->save();

        if($bill){

            $bill_history = new BillHistory();

            $bill_history->bill_id = $bill->id;
            $bill_history->amount_paid = $bill->amount_paid;
            $bill_history->offices_id = $bill->office_name;
            $bill_history->bill_type = $bill->bill_type;
            $bill_history->date_paid = $bill->date_paid;
            $bill_history->renewal_date = $bill->renewal_date;
            $bill_history->duration = $bill->duration;

            $bill_history->save();

            alert()->success('Bill created Succesfully', '');
            return redirect()->back()->with("success","Bill created Succesfully");
        }
    }

    public function viewBill()
    {   
        $bills = BillHistory::join('offices', 'offices.id', 'bill_histories.offices_id')
            ->get(['bill_histories.*', 'offices.name as offices']);

        //dd($bills);
        //return response()->json(SecurityPaymentHistory::with("offices")->get());

        return view("admin.rent.viewBills", compact('bills'));
    }

    public function editBillForm($id)
    {
        $sec = BillHistory::find($id);
        $rec = Bill::where('id', $sec->bill_id)->first();
        //dd($rec->id);
        $offices = Office::all();
        // dd($offices);

        return view("admin.rent.editBills", compact('rec', 'offices'));
    }

    public function updateBill(Request $request, $id)
    {
        $validatedData = $request->validate([
            'office_name' => 'required',
            'office_address' => 'required',
            'phone_number' => 'required',
            'amount_paid' => 'required',
            'bill_type' => 'required',
            'tenure' => 'required',
            'duration' => 'required',
            'date_paid' => 'required',
            'renewal_date' => 'required',
        ]);
        //dd($id);
        $bill = Bill::find($id);
        //dd($sec);

        $bill->office_name = $request->office_name;
        $bill->office_address = $request->office_address;
        $bill->phone_number = $request->phone_number;
        $bill->amount_paid = $request->amount_paid;
        $bill->bill_type = $request->bill_type;
        $bill->tenure = $request->tenure;
        $bill->duration = $request->duration;
        $bill->date_paid = $request->date_paid;
        $bill->renewal_date = $request->renewal_date;

        $bill->save();
        
        if($bill){

            $bill_history = BillHistory::where('bill_id', $bill->id)->first();
            //dd($sec_history);

            $bill_history->bill_id = $bill->id;
            $bill_history->amount_paid = $bill->amount_paid;
            $bill_history->offices_id = $bill->office_name;
            $bill_history->bill_type = $bill->bill_type;
            $bill_history->date_paid = $bill->date_paid;
            $bill_history->renewal_date = $bill->renewal_date;
            $bill_history->duration = $bill->duration;

            $bill_history->save();

            alert()->success('Bill Updated Succesfully', '');
            return redirect('/viewBill')->with("success","Bill Updated Succesfully");
        }
    }

    public function deleteBill($id)
    {
        $bill_hist = BillHistory::find($id);
        $rec = Bill::where('id', $bill_hist->bill_id)->first();
        //dd($rec);
        $rec->delete();

        if($rec){
            $bill_hist->delete();

            alert()->success('Bill Deleted succesfully', '');
            return redirect()->back()->with("success","Bill Deleted succesfully");
        }

        
    }

    /* Bills ends here */
}
