<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CashierWalletHistory extends Model
{
        protected $table = "cashier_wallet_histories";

    public function sender(){
        return $this->belongsTo('App\User', 'from_id', 'id');
    }

    public function recipient(){
        return $this->belongsTo('App\User', 'to_id', 'id');
    }
}
