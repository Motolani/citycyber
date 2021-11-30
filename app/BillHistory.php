<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillHistory extends Model
{
    protected $table = "bill_histories";

    protected $fillable = [
        'bill_id',
        'amount_paid',
        'offices',
        'bill_type',
        'date_paid',
        'renewal_date',
        'duration',
        
    ];

    public function offices(){
        return $this->hasMany(\App\Office::class,"bill_id","bill_id");
    }
}
