<?php

namespace App\Http\Controllers;

use App\Department;
use App\IncidenceOpration;
use App\Office;
use App\OfficeStock;
use App\Reason;
use App\Asset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\Offices;
use Illuminate\Support\Facades\Validator;



class AssetController extends Controller
{
        public function __construct()
        {
            $this->middleware('auth');
        }

          
        
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AssetIndex()

    {
        $asset = Asset::all();
        return view('admin.view-asset', compact('asset'));

        
      
        //
        // dd ($service);
    }
        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAsset()
    {
        
       
        return view('admin.create-asset');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAsset(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type' =>'required',
            
        ]);
        

        $asset = new Asset();

        $asset->type = $request->type;
        // dd($asset);
    
        $asset->save();

        return redirect('view-asset')->with('status','asset data successfully inserted');
       
            
    }
    public function editAsset($id)
    {
        // dd($id);
        $asset = Asset::find($id);
        // var_dump($asset);die();
        // dd($asset);
        return view('admin.edit-asset',compact('asset'));
        //
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAsset(Request $request, $id)
    {
        $asset  = Asset::find($id);
        $asset->type = $request->type;
       
         //store data
        
       
         $asset->save();
       
     
            return redirect('view-asset')->with('status','asset updated succesfully ');

    }
    public function deleteAsset(Request $request)
    {
    
        $id = $request->id;
        $asset  = Asset::find($id);
        $asset  ->delete();
        return redirect()->back()->with('status','asset  data succesfully deleted');
    }
        

        //
    

}
