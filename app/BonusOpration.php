<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonusOpration extends Model
{
    protected $table = "bonusoprations";

    protected $fillable = [
        'branch_id', 'staff_id', 'bonus_id', 'status', 'comment', 'issuer_id',
    ];


    public function staff()
    {
        return $this->belongsTo('App\User', 'staff_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\User', 'issuer_id', 'id');
    }
}
