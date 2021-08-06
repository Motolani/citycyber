<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
        protected $table = "loantypes";

        protected $fillable = [
            'loanName','status',
                ];
}

