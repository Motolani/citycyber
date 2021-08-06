<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationType extends Model
{
        protected $table = "educationtype";
	protected $fillable = [
		"type"
	];
} 
