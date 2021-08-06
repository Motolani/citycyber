<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class RepaymentType extends Model
{
        protected $table = "repaymenttypes";

        protected $fillable = [
            'repaymentName','status',
                ];
}

