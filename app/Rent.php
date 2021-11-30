<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $table = "rents";

    protected $fillable = [
        'office_name',
        'office_address',
        'phone_number',
        'amount_paid',
        'rent_type',
        'tenure',
        'duration',
        'date_paid',
        'renewal_date',
        'landlord_name',
        'landlord_address',
        'landlord_phone',
        'landlord_email',
        
    ];
}
