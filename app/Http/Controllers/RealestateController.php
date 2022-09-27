<?php

namespace App\Http\Controllers;

use App\RealEstate;
use Illuminate\Http\Request;

class RealestateController extends Controller
{
    public function index()
    {
        $real_estates = RealEstate::all();

        return view("admin.real-estate.viewEstate", compact('real_estates'));
    }

    public function create()
    {
        return view("admin.real-estate.createEstate");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'type' => 'required',
            'address' => 'required',
        ]);

        $real = new RealEstate();

        $real->name = $request->name;
        $real->phone_number = $request->phone_number;
        $real->email = $request->email;
        $real->type = $request->type;
        $real->address = $request->address;

        $real->save();

        alert()->success('Landlord/Caretaker created succesfully', '');
        return redirect()->back()->with("success","Landlord/Caretaker created succesfully");
    }

    public function edit($id)
    {
        $real = RealEstate::find($id);

        return view("admin.real-estate.editEstate", compact('real'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'type' => 'required',
            'address' => 'required',
        ]);

        $real = RealEstate::find($id);

        $real->name = $request->name;
        $real->phone_number = $request->phone_number;
        $real->email = $request->email;
        $real->type = $request->type;
        $real->address = $request->address;

        $real->save();

        alert()->success('Landlord/Caretaker updated succesfully', '');
        return redirect()->back()->with("success","Landlord/Caretaker updated succesfully");
    }

    public function destroy($id)
    {
        $real = RealEstate::find($id);
        $real->delete();

        alert()->success('Landlord/Caretaker deleted succesfully', '');
        return redirect()->back()->with("success","Landlord/Caretaker deleted succesfully");
    }
}
