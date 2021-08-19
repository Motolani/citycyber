<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CashReserveWallet extends Model
{
        protected $table = "cash_reserves_wallets";

    public function manager(){
        return $this->belongsTo('App\User', 'staff_id', 'id');
    }
}
