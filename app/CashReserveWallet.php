<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CashReserveWallet extends Model
{
    protected $table = "cash_reserves";
    protected $fillable = [
        'balance'];

    public function branchManager(){
        return $this->belongsTo('App\User', 'staff_id', 'id');
    }

    public function areaManager(){
        return $this->belongsTo('App\User', 'am_id', 'id');
    }

    public function office(){
        return $this->belongsTo('App\Office', 'office_id', 'id');
    }

    public function sender(){
        return $this->belongsTo('App\User', 'from_id', 'id');
    }

    public function recipient(){
        return $this->belongsTo('App\User', 'to_id', 'id');
    }


    protected static function boot()
    {
        parent::boot();

        //Watch the update event to detect balance changes and Log them in Transaction Log cash_reserve_histories
        CashReserveWallet::updated(function ($cashReserve) {
            //TODO  Check if it's the balance that is updated
            $balanceBefore = $cashReserve->getOriginal('balance');
            $cashReserve->refresh();
            $balanceAfter = $cashReserve->balance;
            //abs function will remove negative sign in case balanceBefore is more than balanceAfter
            $amount = abs($balanceAfter - $balanceBefore);
            $type = ($balanceAfter > $balanceBefore) ? "credit" : "debit";

            //Log the transaction in History
            $history = new CashReserveHistory();
            $history->bm_id = $cashReserve->staff_id;
            $history->cash_reserve_id = $cashReserve->id;
            $history->from_id = Auth::user()->id;
            $history->to_id = $cashReserve->staff_id;
            $history->amount = $amount;
            $history->balance_after = $balanceAfter;
            $history->type = $type;
            $history->save();
        });
    }
}
