<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";

    protected $fillable = [
        'customer_id','bank_id','amount','charge','type','actual_amount','status','reference','pos_id','lastfourdigit'
    ];
}



