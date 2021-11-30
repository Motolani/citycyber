<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";

    protected $fillable = [
        'customer_id','customer_name','bank_id','terminal_id','bank_name','amount','account_holder_name','charge','type','actual_amount','status','reference','pos_id','lastfourdigit'
    ];
}



