<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameCommission extends Model
{
    
    protected $table = "game_commission";

    protected $fillable = [
        'game_name',
        'amount',
        'date_range_from',
        'date_range_to',
        'created_at',
        'updated_at',
    ];
}
