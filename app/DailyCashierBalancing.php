<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyCashierBalancing extends Model
{
    //
    protected $table ="daily_cashier_balancing_cash";
     protected $fillable = [
        'date',
        'office_id',
        'user_id',
        'one_thousand',
        'five_hundred',
        'two_hundred',
        'one_hundred',
        'fifty_naira',
        'twenty_naira',
        'ten_naira',
        'five_naira',
        'total_cash',
        'total_stake',
        'total_bet_number',
        'total_cash_bet',
        'total_cash_remit'
    ];
}
