<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CableType extends Model
{
    //
    protected $table ='cable_tv_type';
    protected $fillable = [
        'cable_type_name',
    ];
}
