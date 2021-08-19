<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = "games";

    protected $fillable = [
        'office_id','ticket_id','customer_id','cashier_id','amount','type','payment','pos_id','bank_id','status'
    ];
}
