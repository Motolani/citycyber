<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CashReserveHistory extends Model
{
    protected $table = "cash_reserve_histories";

//    public function office(){
//        return $this->belongsTo('App\Office', 'office_id', 'id');
//    }
//
//    public function user(){
//        return $this->belongsTo('App\User', 'staff_id', 'id');
//    }


    protected static function boot()
    {
        parent::boot();

        //Watch the update event to detect balance changes and Log them in Transaction Log
        CashReserveWallet::updated(function ($cashReserve) {
            $balanceBefore = $cashReserve->getOriginal('balance');
            $balanceAfter = $cashReserve->balance;
            //abs function will remove negative sign in case balanceBefore is more than balanceAfter
            $amount = abs($balanceAfter - $balanceBefore);
            $type = ($balanceAfter > $balanceBefore) ? "INSLIP" : "OUTSLIP";

            //Log the transaction in History
            $history = new CashReserveHistory();
            $history->bm_id = $cashReserve->office_id;
            $history->bank_account_id = "";
            $history->amount = $amount;
            $history->balance_after = $balanceAfter;
            $history->type = $type;
            $history->save();
        });
    }
}
