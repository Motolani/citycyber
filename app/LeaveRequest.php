<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
        protected $table = "leaverequests";

        protected $fillable = [
            'staff_id','leavecategory_id','leavetype_id','comment','dates','status'
                ];
}
