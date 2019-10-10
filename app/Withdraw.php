<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdraw extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'withdraws';
    protected $primaryKey = 'withdraw_id';

    protected $fillable = ['date', 'amount', 'balance', 'more_info'];

    public function partners(){
        return $this->belongsTo('App\Partner');
    }
}
