<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    protected $table = "payslips";

    protected $fillable = ['staff_id','issuer_id','basic_salary','advance','allowance','bonus','deduction','offence','pension','tax','loan','net_salary','amount'];
}
