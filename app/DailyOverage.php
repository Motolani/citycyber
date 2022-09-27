<?php

namespace App;

use App\GameName;
use Illuminate\Database\Eloquent\Model;

class DailyOverage extends Model
{
    //
   
    protected $table = "virtual_overage";

    protected $fillable = [
        'game_name',
        'amount',
        'date',
        'created_at',
        'updated_at',
    ];
    public function gameName()
    {
        return $this->belongsToMany('App\GameName');
    }
}
