<?php
namespace App\Http\Controllers;

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


class Inventories extends BaseController
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



    public function CreateinventoryView()
    {
        // $categories = Department::all();
        $categories = StockCategory::all();
        $stores = Office::where("has_store", true)->get();
        return view('admin.inventory.inventory', compact('categories', 'stores'));
    }



    //crete new stock

    public function createNewStockRegular(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'price' => 'required|max:25',
            'office_id' => 'required|max:25',
            'description' => 'required|max:255',
        ]);

        $createStock = new Inventory_Store([
            "name"=> $request->name,
            "price"=> $request->price,
            "office_id"=>$request->office_id,
            "description"=>$request->description,
        ]);
        $createStock->save();

        alert()->success("Successfully Created Stock", 'Success');
        return redirect()->back();

    }


    public function createStock(Request $request)
    {
        $request->validate([
            'stock_name' => 'required|max:200',
            'stock_price' => 'required|max:255',
            'office_id' => 'required|max:255',
            'stock_description' => 'required|max:255',
            'stock_depreciation_rate' => 'required|max:255',

        ]);
        //  dd($request);


        $len = sizeof($request->stock_name);
        $count = 0;
        for($i = 0; $i<$len;$i++){
            try{
                $createStock = new Inventory_Store([
                    "name"=>$request->stock_name[$i],
                    "price"=>$request->stock_price[$i],
                    "office_id"=>$request->office_id[$i],
                    "description"=>$request->stock_description[$i],
                    "description_rate"=>$request->stock_depreciation_rate[$i],
                    "description_period"=>$request->stock_depreciation_period[$i],
                    "type"=>$request->stock_depreciation_period[$i],
                    "status"=>"pending"
                ]);

                if($createStock->save()){
                    $count+=1;
                }else{

                }
            }
            catch(Exception $ex){
                //	dd($ex);
            }
        }

        // dd($count);
        if($count== $len){
            return redirect()->back()->with('message', 'Stock is created successfully');
        }
        else if($count>0){
            return redirect()->back()->with('error', 'Not all the Stocks were added Successfully');
        }
        else{
            return redirect()->back()->with('error', 'Stock is not created successfully');
        }
    }



    public function viewStock(Request $request)
    {
        $user_id = Auth::user()->id;
        $stocks = Inventory_Store::all();

        return view('admin.inventory.viewStock',compact(['stocks']));
    }


    public function assignProductToOfficeView(Request $request)
    {
        $products = Inventory_Store::where('status','pending')->get();
        $branch_id = Auth::user()->branchId;
        // dd($branch_id);
        $offs = Office::where('id',$branch_id)->first();
        $offices = Office::where('id',$offs->parentOfficeId)->get();

        return view('admin.inventory.assignProductToOffice',compact(['products','offices']));
    }



    public function assignProductToOffice(Request $request)
    {
        $request->validate([
            'payment_period' => 'required',
            'quantity' => 'required',
        ]);

        $dueDate = Carbon::now()->addWeek($request->payment_period);

        $expProduct = explode("|",$request->product_id);
        $expOffice = explode("|",$request->office_id);
        $productName = $expProduct[1];
        $productId = $expProduct[0];
        $officeName = $expOffice[1];
        $officeId = $expOffice[0];
        // dd($productId."".$productId);

        $check = Inventory_Store::where("category",$productName)->where('status','pending');
        if($check->count() > $request->quantity){
            $inventory = $check->limit($request->quantity)->get();
            $user_id = Auth::user()->id;
            // dd($user_id);

            $counter = 0;
            foreach($inventory as $data){
                // dd($data);
                $updated = Inventory_Store::where('id',$data->id)->update(["status"=>"processing"]);
                if($updated){
                    $counter+=1;
                    $transfer = new OfficeStock([
                        // "brand_name"=>$request->name,
                        "category_id"=>$productId,
                        "category"=>$productName,
                        "sender_id"=>$user_id,
                        "to_office_id"=>$officeId,
                        "description"=>$request->comment,
                        "office_name"=>$request->officeName,
                        "inventory_id"=>$data->id,
                        "due_date"=>$dueDate,
                        "payment_period"=>$request->payment_period,
                        // "depreciation_rate"=>,
                        // "depreciation_period"=>"",
                        // "ticket_id"=>"",
                        "status"=>"processing",
                    ]);

                    $transfer->save();
                }
            }
            // dd($counter);
            return redirect()->back()->with("message","Product Successfully Assigned");
        }else{
            return redirect()->back()->with("message","there are only ".$check->count()." of the selected products available");
        }

    }


    public function viewTransafer(Request $request)
    {
        $user_id = Auth::user()->id;
        $transfers = OfficeStock::join('users','users.id','transfers.sender_id')->join('offices','offices.id','transfers.to_office_id')
            ->select("users.firstname as sender_name","offices.name as officeName","transfers.*")
            ->get();

        return view('admin.inventory.transfer',compact(['transfers']));
    }

    //this function handles aproval and disapproval of Stock by Children 
    public function approveDisapproveStock(Request $request)
    {


        if($request->action == "approve"){
            // dd($request);
            $user_id = Auth::user()->id;
            $tran = OfficeStock::where('id',$request->action_id)->update(["status"=>"Approved","comment"=>$request->comment,"receiver_id"=>$user_id]);
            $user_id = Auth::user()->id;
            $transfers = OfficeStock::join('users','users.id','transfers.sender_id')->join('offices','offices.id','transfers.to_office_id')
                ->select("users.firstname as sender_name","offices.name as officeName","transfers.*")
                ->get();
            // dd($tran);
            if($tran){

                $message = "Stock has been Approved in Successfully";
                return view('admin.inventory.transfer',compact(['transfers','message']))->with("message",$message);
                //return redirect()->back()->with("message","Stock Approved Successfully");
            }else{
                $message = "Stock has could not be Approved in Successfully";
                return view('admin.inventory.transfer',compact(['transfers','message']))->with("message",$message);
            }
        }

        else if($request->action == "disapprove"){
            $user_id = Auth::user()->id;
            $transfers = OfficeStock::where('id',$request->action_id)->update(["status"=>"Disapproved","comment"=>$request->comment,"receiver_id"=>$user_id]);
            if($transfers){
                $user_id = Auth::user()->id;
                $transfers = OfficeStock::join('users','users.id','transfers.sender_id')->join('offices','offices.id','transfers.to_office_id')
                    ->select("users.firstname as sender_name","offices.name as officeName","transfers.*")
                    ->get();
                $message = "Stock has been Approved in Successfully";
                return view('admin.inventory.transfer',compact(['transfers','message']))->with("message",$message);
                //return redirect()->back()->with("message","Stock Approved Successfully");
            }

        }else{

        }
        $user_id = Auth::user()->id;
        $transfers = OfficeStock::where(1);


        return view('admin.inventory.transfer',compact(['transfers']));
    }






    public function destroy(Request $request, $id)
    {
        $deleted = Department::find($id)->delete();
        return redirect()->back()->with('message', $deleted ? 'Deleted successfully!.' : 'Error deleting department!.');
//        return Department::find($id)->delete();
    }
}

