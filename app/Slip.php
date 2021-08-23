<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
//    public function cashiers(){
//        return $this->hasMany('App\CashierWallet', 'office_id', 'id');
//    }
//
    public function office(){
        return $this->hasOne('App\Office', 'id', 'manager_office_id');
    }

    public function cashier(){
        return $this->belongsTo('App\CashierWallet', 'cashier_id', 'id');
    }

    public function bm(){
        return $this->belongsTo('App\CashierWallet', 'manager_office_id', 'id');
    }

}
