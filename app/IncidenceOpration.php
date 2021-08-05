<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidenceOpration extends Model
{
        protected $table = "incidenceoprations";

        protected $fillable = [
            'branch_id','staff_id','offence_id','status','comment','issuer_id',
                ];

    public function staff(){
        return $this->belongsTo('App\User', 'staff_id', 'id');
    }

    public function admin(){
        return $this->belongsTo('App\User', 'issuer_id', 'id');
    }
}
