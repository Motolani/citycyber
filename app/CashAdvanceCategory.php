<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CashAdvanceCategory extends Model
{
    protected $table = "cash_advance_categories";
    
    protected $fillable = [
        'name', 'cost', 'category_id'
    ];
}
