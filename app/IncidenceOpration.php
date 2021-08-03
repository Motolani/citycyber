<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidenceOpration extends Model
{
        protected $table = "incidenceoprations";

        protected $fillable = [
            'branch_id','staff_id','offence_id','status','comment','issuer_id',
                ];
}
