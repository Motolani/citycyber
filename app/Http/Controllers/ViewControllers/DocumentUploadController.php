<?php

namespace App\Http\Controllers\ViewControllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Offices;
use Illuminate\Http\Request;

use App\Http\Controllers\Core\CreateStaffClass;
use App\Http\Controllers\Core\StaffController;
use App\Unit;
use App\EducationType;
use App\Qualification;
use App\Bank;
use App\Department;
use App\Classes;
use App\Status;
use App\ResumptionType;
use App\Level;
use App\User;
use App\DocumentStorage;

class DocumentUploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function displayDocument($id, $levelid)
    {
        // return response()->json([
        //     "response" => $response
        // ]);
    }

    public function uploadDocument(Request $request)
    {
        //dd($request->all());

        $this->validate($request, [
            'requireddocuments' => 'required',
            'staffid' => 'required',
            'levelid' => 'required'
        ]);


        $requireddocuments = json_decode($request->requireddocuments);

        foreach ($requireddocuments as $document) {
            $docName = "doc" . $document->id;

            if($request->hasFile($docName)){

                // Get filename with the extension
                $filenameWithExt = $request->file($docName)->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

                // Get just ext
                $extension = $request->file($docName)->getClientOriginalExtension();

                 // Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $request->$docName->move('uploads/documents',$fileNameToStore);

                $docData = [
                    "userId" => $request->staffid,
                    "doc" => $document->name,
                    "docId" => $document->id,
                    "docpath" => $path
                ];

                $docs = DocumentStorage::insert($docData);
            }
        }

        alert()->success('Staff Uploaded Successfully', 'Successful');
        return redirect()->back();
    }
}


