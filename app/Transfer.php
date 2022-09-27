<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = "transfers";

    protected $fillable = [
        'inventory_id',
        'brand_name',
        'category_id',
        'category',
        'sender_id',
        'office_name',
        'to_office_id',
        'description',
        'depreciation_rate',
        'depreciation_period',
        'ticket_id',
        'receiver_id',
        'status',
        'comment'
        
    ];
}
