<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllowanceOpration extends Model
{
    protected $table = "allowanceoprations";

    protected $fillable = [
        'branch_id', 'staff_id', 'allowance_id', 'amount', 'status', 'comment', 'issuer_id', 'startDate', 'endDate'
    ];

    public function staff(){
        return $this->belongsTo("App\User", "staff_id", "id");
    }

    public function admin(){
       return $this->belongsTo("App\User", "issuer_id", "id");
    }
}
