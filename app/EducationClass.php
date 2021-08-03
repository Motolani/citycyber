<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationClass extends Model
{
        protected $table = "classes";

	protected $fillable = [
                "type"
        ];
}
