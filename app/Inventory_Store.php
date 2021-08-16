<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory_Store extends Model
{
        protected $table = "inventory_stores";

        protected $fillable = [
            'category_id','name','category','price','description','description_rate','description_period','type','status'
                ];
}

