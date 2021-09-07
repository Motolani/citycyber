<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = [
        'office_id','cashier_id','gender','customer_name','name','type','office_id','dob','status','customer_code'
    ];
}
