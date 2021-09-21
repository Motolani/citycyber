<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends BaseController
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
        $department = Department::all();
        return view('admin.staff.data.viewDepartment', compact('department'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);
        $department = new Department();
        $department->title = $request->title;
        $department->save();
        alert()->success('Department have been successfully created.', 'Success');
        return redirect()->back()->with('message', 'Department is created successfully');
    }
    public function store(Request $request)
    {
        return null;
    }
    public function update(Request $request, $id)
    {
        $department = Department::find($id);
        $department->title = $request->title;
        $saved = $department->save();
        if($saved) {
            alert()->success('Department have been successfully updated.', 'Success');
            return redirect()->back()->with('message', 'Department is updated successfully');
        }

        else {
            alert()->error('Error updaing department.', 'Error');
            return redirect()->back()->with('message', 'Error updating department');
        }
    }
    public function show(Request $request, $id)
    {
        return Department::find($id);
    }

    public function destroy(Request $request, $id)
    {
        $deleted = Department::find($id)->delete();
        alert()->success('Department have been successfully deleted.', 'Success');
        return redirect()->back()->with('message', $deleted ? 'Deleted successfully!.' : 'Error deleting department!.');
//        return Department::find($id)->delete();
    }
}

