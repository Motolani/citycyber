<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\CurlClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LocationAPIController extends Controller
{
    public  $statesJson;
    public $stateObject;


    function __construct()
    {
        $this->statesJson = file_get_contents(app_path('Http/Controllers/states_and_lga.json'));

        $this->stateObject =  collect(json_decode($this->statesJson));
    }

    static function  getLgaFromState($state): array
    {
        $lga = [];
        $get =  (new LocationAPIController)->stateObject
            ->filter(function ($item) use ($state) {

                return false !== (stristr($item->state->name, $state));
            })
            ->first();

        if ($get != null) {

            foreach ($get->state->locals as $key => $item) {

                array_push($lga, $item->name);
            }
        }

        return $lga;
    }

    static function  getStates(): array
    {
        $states = [];
        $get = (new LocationAPIController)->stateObject->all();

        if ($get != null) {

            foreach ($get as $key => $item) {

                array_push($states, ["name" => $item->state->name, "capital" => $item->state->capital]);
            }
        }
        return $states;
    }

    static  function states()
    {

        $url = "http://locationsng-api.herokuapp.com/api/v1/states";

        $response = CurlClass::curlApi('', $url, 'GET');

        $dec = json_decode($response);

        if (!isset($dec) || isset($dec->status)) {

            $dec = self::getStates();
        }

        return response()->json($dec);
    }

    static function lga(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'state' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => '100',
                'message' => $validate->errors()->first()
            ]);
        }

        $state =   $request->state;


        $url = "http://locationsng-api.herokuapp.com/api/v1/states/$state/lgas";

        $response = CurlClass::curlApi('', $url, 'GET');

        $dec = json_decode($response);

        if (!isset($dec) || isset($dec->status)) {

            $dec = self::getLgaFromState($state);
        }

        return response()->json($dec);
    }
}

