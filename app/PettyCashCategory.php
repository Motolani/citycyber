<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PettyCashCategory extends Model
{
    protected $table = "petty_cash_categories";

    protected $fillable = [
        'name', 'description', 'status', 'created_at', 'updated_at'
    ];

    // public function staff(){
    //     return $this->belongsTo("App\User", "staff_id", "id");
    // }

    // public function admin(){
    //    return $this->belongsTo("App\User", "issuer_id", "id");
    // }
}
