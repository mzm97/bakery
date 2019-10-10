<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'attendances';
    protected $primaryKey = 'attendance_id';
    protected $fillable = ['attendance_status', 'attendance_date'];

    public function employees(){
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}
