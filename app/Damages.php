<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Damages extends Model
{
    protected $table = "lossdamageoperations";

        protected $fillable = [
            'amount','branch_id','staff_id','allowance_id','status','property_lost','comment', 'issuer_id'
                ];

    public function staff(){
        return $this->belongsTo('App\User', 'staff_id', 'id');
    }

    public function admin(){
        return $this->belongsTo('App\User', 'issuer_id', 'id');
    }
}
