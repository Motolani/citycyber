<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PettyCashRetirement extends Model
{
    protected $table = "petty_cash_retirements";

    protected $fillable = [
        'staff_id', 'branch_id', 'request_id', 'upload_path', 'amount', 'comment', 'remark', 'description', 'status', 'created_at', 'updated_at'
    ];

    // public function staff(){
    //     return $this->belongsTo("App\User", "staff_id", "id");
    // }

    // public function admin(){
    //    return $this->belongsTo("App\User", "issuer_id", "id");
    // }
}
