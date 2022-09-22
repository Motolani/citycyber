<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoolWallet extends Model
{
    protected $table = "pool_wallet";

	protected $fillable = [
        'balance','wallet_code'
    ];
}
