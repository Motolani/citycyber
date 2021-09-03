<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    public function cashiers(){
        return $this->hasMany('App\CashierWallet', 'office_id', 'id');
    }

    public function shopWallet(){
        return $this->hasOne('App\ShopWallet', 'office_id', 'id');
    }


    public function cashReserve(){
        return $this->hasOne('App\CashReserveWallet', 'office_id', 'id');
    }

    public function manager(){
        return $this->belongsTo('App\User', 'managerid', 'id');
    }
}
