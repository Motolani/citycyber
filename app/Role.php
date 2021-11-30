<?php namespace App;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

  protected $throwValidationExceptions = true;

  protected $fillable = [
    'name',
    'display_name',
    'description',
  ];

  protected $rules = [
    'name'      => 'required|unique:roles',
    'display_name'      => 'required|unique:roles',
  ];
}
