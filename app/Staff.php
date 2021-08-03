<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
            'firstname', 'middlename', 'lastname','homeAddress','residentialAddress','phone','email','password','dob','state','status','level',
            'resumptionType','imgUrl','branchId','unit','department','departmeentrole','position','resumptionDate','assumptionDate',
            'lga','country','gender','maritalstatus','username'
        ];
}
