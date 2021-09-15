<?php
namespace App\Http\Controllers;

use App\Cities;
use App\Countries;
use App\States;
use Illuminate\Http\Request;
use App\Bonus;
use App\BonusOpration;
use App\Level;
use App\Pos;
use App\Customer;
use App\Payment;
use Illuminate\Support\Facades\DB;
use SweetAlert;
use Illuminate\Support\Facades\Auth;

class AddressController extends BaseController
{
    public function getCountries(){
        $countries = Countries::all();
        return response(Utility::returnSuccess("All Countries fetched", $countries));
    }

    public function getStatesByCountry(Request $request, $country_id){
        $states = States::where('country_id', $country_id)->get();
        return response(Utility::returnSuccess("States fetched", $states));
    }


    public function getCitiesByState(Request $request, $state_id){
        $cities = Cities::where('state_id', $state_id)->get();
        return response(Utility::returnSuccess("Cities fetched", $cities));
    }

}

