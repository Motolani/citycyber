<?php
namespace App\Http\Controllers;

use App\CashAdvanceRequest;
use App\Reason;
use App\StockCategory;
use App\Inventory_Store;
use App\Office;
use App\OfficeStock;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class ReasonController extends BaseController
{
    public function index()
    {
        $items = Reason::all();
        return view('admin.reason.index', compact('items'));
    }



    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:1',
            'description' => 'required',
        ]);
        $item = new Reason();
        $item->name = $request->name;
        $item->save();

        alert()->success('Saved successfully.', 'Successful');
        return redirect()->back()->with('message', 'Saved successfully');
    }


    public function createNewReason(Request $request){
        $request->validate([
            'name' => 'required|max:255|min:3',
        ]);
        $category = new Reason();
        $category->name = $request->name;
        $category->save();

        alert()->success("The Reason have been successfully added", 'Success');
        return redirect()->back();
    }

    public function delete(Request $request, $id){
        Reason::where('id', $id)->delete();

        alert()->success("The Category have been successfully deleted", 'Success');
        return redirect()->back();
    }
}

