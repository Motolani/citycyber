<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumptionType extends Model
{
        protected $table = "resumptiontypes";
	protected $fillable = [
             'title','starttime','endtime'];
}
