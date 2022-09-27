<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameService extends Model
{
    //
    protected $table ="game_service";
     protected $fillable = [
        'game_name',
        'created_at',
        'updated_at',
       
    ];
}