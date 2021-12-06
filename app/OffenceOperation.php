<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OffenceOperation extends Model
{
    protected $table = "offenceoperations";

    protected $fillable = [
        'amount','branch_id','staff_id','offence_id','status','comment','issuer_id' 
    ];

    public function staff()
    {
        return $this->belongsTo('App\User', 'staff_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\User', 'issuer_id', 'id');
    }

    public function offences(){
        return $this->belongsTo('App\offence', 'offence_id', 'id');
    }
}
