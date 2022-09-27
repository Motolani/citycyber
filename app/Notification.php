<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        "title","senderName","senderId","senderEmail","message","status","type","staff_id"
    ];
}
