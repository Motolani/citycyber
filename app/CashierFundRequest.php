<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CashierFundRequest extends Model
{
    protected $table = "cashier_fund_requests";

    public function cashier(){
        return $this->belongsTo('App\User', 'cashier_id', 'id');
    }
}
