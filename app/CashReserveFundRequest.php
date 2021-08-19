<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CashReserveFundRequest extends Model
{
    protected $table = "cash_reserves_fund_requests";

//    public function cashier(){
//        return $this->belongsTo('App\User', 'cashier_id', 'id');
//    }
}
