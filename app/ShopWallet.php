<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ShopWallet extends Model
{
    protected $fillable = [
        'balance'];

    protected $table = "shop_wallets";

    public function office()
    {
        return $this->belongsTo('App\Office', 'office_id', 'id');
    }

    public function getFullName(){
        return $this->firstname . " " . $this->lastname;
    }


    protected static function boot()
    {
        parent::boot();

        //Watch the update event to detect balance changes and Log them in Transaction Log
        ShopWallet::updated(function ($shop) {
            $balanceBefore = $shop->getOriginal('balance');
            $shop->refresh();
            $balanceAfter = $shop->balance;

            //abs function will remove negative sign in case balanceBefore is more than balanceAfter
            $amount = abs($balanceAfter - $balanceBefore);
            $type = ($balanceAfter > $balanceBefore) ? "credit" : "debit";

            //Log the transaction in History
            $history = new ShopWalletHistory();
            $history->shop_wallet_id = $shop->id;
            $history->staff_id = $shop->office->manager->id;
            $history->from_id = Auth::user()->id;
            $history->to_id = $shop->office->manager->id;
            $history->amount = $amount;
            $history->balance_after = $balanceAfter;
            $history->type = $type;
            $history->save();
        });
    }
}
