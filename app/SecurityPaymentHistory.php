<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecurityPaymentHistory extends Model
{
    protected $table = "security_payment_histories";

    protected $fillable = [
        'security_id',
        'amount_paid',
        'offices',
        'date_paid',
        'renewal_date',
        'duration',
        
    ];

    public function offices(){
        return $this->hasMany(\App\Office::class,"security_id","security_id",);
    }
}
