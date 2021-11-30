<?php namespace App;

use Esensi\Model\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Permission extends EloquentModel
{

  protected $throwValidationExceptions = true;

  protected $fillable = [
    'name',
    'display_name',
    'description',
  ];

  protected $rules = [
    'name'      => 'required|unique:permissions',
  ];
}
