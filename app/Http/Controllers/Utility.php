<?php

/**
 * Created by PhpStorm.
 * User: LordRahl
 * Date: 3/17/17
 * Time: 11:02 PM
 */

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class Utility {

    public function __construct() {

    }

    /*-----------------------------------
    * @return Error Message
    -----------------------------------*/
    static function returnError($message = "An error occurred", $details=null) {
        $msg = [
            'status'=>'error',
            'message'=> $message,
            'details' => $details];
        return $msg;
    }


    /*-----------------------------------
 * @return Success Message using the JSend JSON specs
 -----------------------------------*/
    static function returnSuccess($message = "The operation was successful", $data= null) {
        $msg = [
            'status'=>'success',
            'message'=> $message,
            'data' => $data];
        return $msg;
    }

}
