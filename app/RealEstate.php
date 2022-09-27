<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    protected $table = "real_estates";

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'type',
        'address',
    ];
}
