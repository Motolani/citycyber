<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfitLossAccount extends Model
{
    protected $table = "profit_and_loss_acct";

    protected $fillable = [
        'commission',
        'sales',
        'services',
        'web_hook',
        'unclaim_winning',
        'salary_and_wages',
        'insurance',
        'loan',
        'rent',
        'income_tax',
        'depreciation',
        'subscription',
        'govt_tax_and_levies',
        
    ];
}
