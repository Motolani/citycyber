<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class SuspensionOpration extends Model
{
        protected $table = "suspensionoprations";

        protected $fillable = [
            'branch_id','staff_id','bonus_id','status','comment','issuer_id','startDate','endDate'
                ];
}
