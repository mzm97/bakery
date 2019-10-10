<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseType extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'expense_types';
    protected $primaryKey = 'expense_type_id';

    protected $fillable = ['expense_type', 'more_info'];

    public function expenses(){
        return $this->hasMany('App\Expense', 'expense_type_id');
    }
}
