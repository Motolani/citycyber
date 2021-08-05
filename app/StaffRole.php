<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffRole extends Model
{
        protected $table = "staffroles";
	protected $fillable = array(
        	'role'
    	);
}
