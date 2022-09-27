<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "bills";

    protected $fillable = [
        'office_name',
        'office_address',
        'phone_number',
        'amount_paid',
        'bill_type',
        'tenure',
        'duration',
        'date_paid',
        'renewal_date',
        
    ];
}
