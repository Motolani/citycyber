<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    protected $table = "environments";

    protected $fillable = [
        'office_name',
        'office_address',
        'phone_number',
        'amount_paid',
        'tenure',
        'duration',
        'date_paid',
        'renewal_date',
        
    ];
}
