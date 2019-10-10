<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OverTime extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'over_times';
    protected $primaryKey = 'over_time_id';
    protected $fillable = ['over_time_money'];

    public function employees(){
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}
