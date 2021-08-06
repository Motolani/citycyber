<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvanceOpration extends Model
{
    protected $table = "advanceoperations";

    protected $fillable = [
        'amount', 'branch_id', 'staff_id', 'advance_id', 'status', 'comment', 'issuer_id', 'startDate', 'endDate'
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
