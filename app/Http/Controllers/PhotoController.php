<?php

namespace App\Http\Controllers;

use App\IncidenceOpration;
use App\Office;
use App\PettyCashRequest;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Auth;

class PhotoController extends BaseController
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

    public function viewAddPhotos(Request $request, $office_id)
    {
        $office = Office::where('id', $office_id)->first();
        return view('admin.photos.add-photos', compact('office'));
    }

    public function doAddPhotos(Request $request, $office_id)
    {
        $request->validate([
            'photo' => 'required|mimes:jpg,png',
        ]);
        $office = Office::where('id', $office_id)->first();

        if(isset($office)) {
            $fileName = time() . '.' . $request->photo->extension();
            $path = $request->photo->move('uploads', $fileName);

            $photo = new Photo();
            $photo->path = $path;
            $photo->office_id = $office->id;
            $photo->save();
        }

        alert()->success('Photo have been uploaded successfully.', 'Successful');
        return redirect()->back();
    }

    public function setAsDefault(Request $request, $photo_id)
    {
        $office = Auth::user()->office;

        if(isset($office)) {

            //ids of all other photos
            $photo_ids = [];
            foreach ($office->photos as $photo) {
                if ($photo->id != $photo_id) {
                    $photo_ids[] = $photo->id;
                }
            }
            //Update all of the other office photos back to false
            Photo::where('office_id', $office->id)->whereIn('id', $photo_ids)->update(['is_default' => false]);

            //Update the selected photo to true
            Photo::where('office_id', $office->id)->where('id', $photo_id)->update(['is_default' => true]);
        }

        alert()->success('Photo have been set as default.', 'Successful');
        return redirect()->back();
    }


    public function delete(Request $request, $photo_id)
    {
            //ids of all other photos
            $photo = Photo::where('id', $photo_id)->first();
            if (isset($photo)) {
                $deletePhoto = $photo->delete();
                unlink($photo->path);
                alert()->success('Photo have been deleted successfully.', 'Successful');
                return redirect()->back();
            }
            else{
                alert()->error('Photo not found.', 'Error');
                return redirect()->back();
            }
    }


}
