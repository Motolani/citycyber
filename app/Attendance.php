<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = "attendances";

    protected $fillable = [
        'staff_id','staff_number','staff_id','staff_name','office_name','office_id','status','clockOut'
    ];
}

