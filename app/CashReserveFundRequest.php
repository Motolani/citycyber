<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CashReserveFundRequest extends Model
{
        protected $table = "cash_reserves_fund_requests";

    public function branchManager(){
        return $this->belongsTo('App\User', 'manager_id', 'id');
    }

public function areaManager(){
        return $this->belongsTo('App\User', 'am_id', 'id');
    }
}
