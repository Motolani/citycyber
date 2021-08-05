<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class OffCategory extends Model
{
        protected $table = "offcategories";

        protected $fillable = [
            'days','category'
                ];
}
