<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CashReserveWallet extends Model
{
    protected $table = "cash_reserves";

    public function branchManager(){
        return $this->belongsTo('App\User', 'staff_id', 'id');
    }

    public function office(){
        return $this->belongsTo('App\Office', 'office_id', 'id');
    }
}
