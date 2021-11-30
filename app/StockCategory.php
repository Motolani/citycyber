<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class StockCategory extends Model
{
        protected $table = "inventory_categories";

        protected $fillable = [
            'name','description','status'
                ];
}

