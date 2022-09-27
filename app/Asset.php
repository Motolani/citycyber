<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    //
    protected $table ="assets";
     protected $fillable = [
        'type',
        'created_at',
        'updated_at',
       
    ];
}