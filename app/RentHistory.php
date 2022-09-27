<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentHistory extends Model
{
    protected $table = "rent_payment_histories";

    protected $fillable = [
        'rent_id',
        'type',
        'amount_paid',
        'offices',
        'date_paid',
        'renewal_date',
        'duration',
        'landlord_name',
        
    ];

    public function offices(){
        return $this->hasMany(\App\Office::class,"rent_id","rent_id",);
    }
}
