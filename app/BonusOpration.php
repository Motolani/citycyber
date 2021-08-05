<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class BonusOpration extends Model
{
        protected $table = "bonusoprations";

        protected $fillable = [
            'branch_id','staff_id','bonus_id','status','comment','issuer_id',
                ];
}

