<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*    protected $fillable = [
            'name', 'email', 'password','firstname','middlename','lastname','phone','DOB',
        ];*/
    protected $fillable = [
        'firstname','staff_number', 'middlename', 'lastname','homeAddress','residentialAddress','phone','email','password','dob','state','status','level',
        'resumptionType','imgUrl','branchId','unit','department','departmentrole','position','resumptionDate','assumptionDate',
        'lga','country','gender','maritalstatus','username','branchId',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function office(){
        return $this->hasOne('App\Office', 'managerid', 'id');
    }

    public function offices(){
        return $this->hasMany('App\Office', 'managerid', 'id');
    }

    public function getFullName(){
        return $this->firstname . " " . $this->lastname;
    }

    /*
     * Returns if the user is on Leave
     * */
    public function isOnLeave(){
        $leaveRequests = LeaveRequest::where('staff_id', $this->id)
            ->where('status', 1)
            ->whereDate('dates', '>', now()->day)
            ->count();
        return $leaveRequests > 0;
    }
}
