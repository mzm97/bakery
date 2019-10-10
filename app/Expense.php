<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'expenses';
    protected $primaryKey = 'expense_id';

    protected $fillable = ['date', 'amount', 'currency', 'description'];

    public function expense_types(){
        return $this->belongsTo('App\ExpenseType');
    }
}