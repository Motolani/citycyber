<?php
namespace App\Http\Controllers;

use App\StockCategory;
use App\CashAdvanceRequest;
use App\Department;
use App\PettyCashRequest;
use Illuminate\Http\Request;
use SweetAlert;


class StockCategoriesController extends BaseController
{
    public function index()
    {
        $items = StockCategory::all();
        return view('admin.stock-category.index', compact('items'));
    }



    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
        $item = new StockCategory();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->save();

        alert()->success('Saved successfully.', 'Successful');
        return redirect()->back()->with('message', 'Saved successfully');
    }


    public function viewCreate(Request $request)
    {
        $categories = StockCategory::latest()
            ->get();
        return view('admin.cash-advance.create', compact('categories'));
    }

    public function viewSubmitExpense(Request $request, $id)
    {
        $data = CashAdvanceRequest::where('id',$id)->first();
        if(isset($data)){
            return view('admin.cash-advance.submit-expense', compact('data'));
        }
        alert()->error("The requested data was not found", 'Success');
        return redirect()->back()->with('error', 'The requested data was not found');
    }

    public function destroy(Request $request, $id)
    {
        $deleted = Department::find($id)->delete();

        $message = $deleted ? 'Deleted successfully!.' : 'Error deleting department!.';
        alert()->success("$message", 'Success');
        return redirect()->back()->with('message', $message);
//        return Department::find($id)->delete();
    }


    public function doAddCategory(Request $request){
        $request->validate([
            'name' => 'required|max:255|min:3',
        ]);
        $category = new StockCategory();
        $category->name = $request->name;
        $category->save();

        alert()->success("The Category have been successfully added", 'Success');
        return redirect()->back();
    }

    public function delete(Request $request, $id){
        StockCategory::where('id', $id)->delete();

        alert()->success("The Category have been successfully deleted", 'Success');
        return redirect()->back();
    }
}

