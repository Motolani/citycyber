<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class DeductionOpration extends Model
{
        protected $table = "deductionoprations";

        protected $fillable = [
            'branch_id','staff_id','deduction_id','amount','status','comment','issuer_id','startDate','endDate'
                ];
}

