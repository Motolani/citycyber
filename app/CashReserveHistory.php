<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CashReserveHistory extends Model
{
    protected $table = "cash_reserve_histories";

//    public function office(){
//        return $this->belongsTo('App\Office', 'office_id', 'id');
//    }
//
//    public function user(){
//        return $this->belongsTo('App\User', 'staff_id', 'id');
//    }

    public function sender(){
        return $this->belongsTo('App\User', 'from_id', 'id');
    }

    public function recipient(){
        return $this->belongsTo('App\User', 'to_id', 'id');
    }

}
