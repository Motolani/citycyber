<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
        protected $table = "nextofkins";

	 protected $fillable = [
            'userId','name','relationship','phone','address'
	];
}
