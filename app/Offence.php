<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Offence extends Model
{
        protected $table = "offences";
	protected $fillable = array(
        	'name'
    	);
}
