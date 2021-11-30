<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Win extends Model
{
        protected $table = "wins";

        protected $fillable = [
            'office_id','office_name','ticket_id','customer_id','customer_name','cashier_id','cashier_name','amount','type','status'
                ];
}

