<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
        protected $table = "transfers";

        protected $fillable = [
            'brand_name','category','category_id','inventory_id','sender_id','office_name','to_office_id','dsscription','description_rate','description_period','ticket_id','receiver_id','type','status','comment'
                ];
}

