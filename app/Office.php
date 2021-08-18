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

}
