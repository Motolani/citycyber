<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnvironmentalPaymentHistory extends Model
{
    protected $table = "environmental_payment_histories";

    protected $fillable = [
        'environment_id',
        'amount_paid',
        'offices',
        'date_paid',
        'renewal_date',
        'duration',
        
    ];

    public function offices(){
        return $this->hasMany(\App\Office::class,"environment_id","environment_id",);
    }
}
