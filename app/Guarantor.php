<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Guarantor extends Model
{
        protected $table = "guarantors";
	protected $fillable = ['userId', 'name','phone','email','homeAddress','officeAddress'];
}
