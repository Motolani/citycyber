<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CableProvider extends Model
{
    protected $table ='cable_providers';
    protected $fillable = [
           'branch_office',
            'cable_tv_type',
            'cable_plan_type',
            'smart_card'=>'numeric',
    ];
}
            