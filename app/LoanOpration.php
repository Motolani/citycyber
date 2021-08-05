<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanOpration extends Model
{
        protected $table = "loanoprations";

        protected $fillable = [
            'repaymentId','loanTypeId','branch_id','staff_id','amount','status','comment','issuer_id','startDate','endDate'
                ];
}

