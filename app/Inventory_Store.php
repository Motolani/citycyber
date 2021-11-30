<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory_Store extends Model
{
    protected $fillable = [
        'name',
        'office_id',
        'category_id',
        'category',
        'price',
        'description',
        'description_rate',
        'description_period',
        'type',
        'status'
    ];

    protected $table = "inventory_stores";
}

