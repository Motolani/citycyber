<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class OffType extends Model
{
        protected $table = "offtypes";

        protected $fillable = [
            'days','type'
                ];
}
