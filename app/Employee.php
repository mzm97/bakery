<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'employees';
    protected $primaryKey = 'employee_id';

    protected $fillable = ['employee_name', 'position', 'salary', 'currency', 'more_info'];

    public function salary_payments(){
        return $this->hasMany('App\SalaryPayment','employee_id');
    }

    public function attendances(){
        return $this->hasMany('App\Attendance','employee_id');
    }

    public function salaryAdvances(){
        return $this->hasMany('App\SalaryAdvance','employee_id');
    }

    public function overTime(){
        return $this->hasMany('App\OverTime','employee_id');
    }
}
