<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryPayment extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'salary_payments';
    protected $primaryKey = 'salary_payment_id';

    protected $fillable = ['absence_no', 'over_time', 'old_balance', 'advance', 'giving_amount', 'currency'];

    public function employees(){
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}