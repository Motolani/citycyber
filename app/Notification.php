<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        "title","senderId","message","status","type","notifying_name", "recipient_id"
    ];
}
