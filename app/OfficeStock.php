<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeStock extends Model
{
        protected $table = "office_stocks";

        protected $fillable = [
            'brand_name',
            'category',
            'category_id','inventory_id','sender_id',
            'office_name','to_office_id','dsscription',
            'description_rate','description_period','ticket_id','receiver_id','type','status',
            'payment_period',
            'due_date',
            'comment'
                ];

        public function item(){
            return $this->belongsTo('App\Inventory_Store', 'inventory_id', 'id');
        }
}

