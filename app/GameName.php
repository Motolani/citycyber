<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameName extends Model
{
    //
    protected $table ='game_name';
    protected $fillable = [
        'name',
    ];

    public function dailyOverage()
    {
        return $this->belongsToMany('App\DailyOverage');
    }
}
