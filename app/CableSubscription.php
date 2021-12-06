<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CableSubscription extends Model
{
    protected $table ='cable_subscription';
    protected $fillable = [
        'branch_office',
        'cable_plan',
        'cable_tv_type',
        'amount',
        'subscription_date',
        'expiring_date',
        'remark',
    ];
}
