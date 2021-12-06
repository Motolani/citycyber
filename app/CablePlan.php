<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CablePlan extends Model
{
    //
    protected $table ='cable_plan';
    protected $fillable = [
        'cable_plan_name',
        'amount',
        'cable_plan_type',
    ];
}
