<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory_Category extends Model
{
        protected $table = "inventory_categories";

        protected $fillable = [
            'name','description','status'
                ];
}

