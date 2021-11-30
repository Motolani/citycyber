<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank_Account extends Model
{
    protected $table = "bank_accounts";

    protected $fillable = [
        "bank_id","bank_name","account_number","account_holder_name","status","created_by"
    ];
}
