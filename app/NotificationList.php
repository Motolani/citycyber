<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationList extends Model
{
    //
    protected $table = "notification_lists";
	protected $fillable = [
        'notification_id', 'notifying_userid', 'status',"type_id"
    ];
}
