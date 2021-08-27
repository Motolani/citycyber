<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CashierWallet extends Model
{
    protected $fillable = [
        'balance'];

    protected $table = "cashier_wallets";

    public function office(){
        return $this->belongsTo('App\Office', 'office_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'staff_id', 'id');
    }


    protected static function boot()
    {
        parent::boot();

        //Watch the update event to detect balance changes and Log them in Transaction Log
        CashierWallet::updated(function ($cashier) {
            //TODO  Check if it's the balance that is updated
            $balanceBefore = $cashier->getOriginal('balance');
            $cashier->refresh();
            $balanceAfter = $cashier->balance;

            //abs function will remove negative sign in case balanceBefore is more than balanceAfter
            $amount = abs($balanceAfter - $balanceBefore);

            $type = ($balanceAfter > $balanceBefore) ? "credit" : "debit";

            //Log the transaction in History
            $history = new CashierWalletHistory();
            $history->shop_wallet_id = $cashier->office_id;
            $history->staff_id = $cashier->staff_id;
            $history->amount = $amount;
            $history->balance_after = $balanceAfter;
            $history->type = $type;
            $history->save();
        });
    }
}
