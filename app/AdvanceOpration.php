<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvanceOpration extends Model
{
        protected $table = "advanceoperations";

        protected $fillable = [
            'amount','branch_id','staff_id','advance_id','status','comment','issuer_id','startDate','endDate'
                ];
}

