<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
        protected $table = "workexperiences";

	protected $fillable = [
            'userId','nameOfEstablish','position','jobFunction','startyear','endyear'];
}
