<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffBankAcc extends Model
{
        protected $table = "staffbankacc";
	 protected $fillable = [
            'userId', 'bankname','acc_num','acc_name','acc_type'];
}
