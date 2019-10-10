<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryAdvance extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'salary_advances';
    protected $primaryKey = 'salary_advance_id';
    protected $fillable = ['advance_money'];

    public function employees(){
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}
