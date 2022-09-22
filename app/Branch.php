<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    protected $table ="branchs";
     protected $fillable = [
        'type',
        'created_at',
        'updated_at',
       
    ];
}