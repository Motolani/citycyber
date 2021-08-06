<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    protected $table = "emergencycontact";
    protected $fillable = ['userId', 'name','phone','address'];
}
