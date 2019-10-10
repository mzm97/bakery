<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerLedger extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'customer_ledgers';
    protected $primaryKey = 'customer_ledger_id';

    protected $fillable = ['date', 'received_debt', 'more_info'];

    public function customers(){
        return $this->belongsTo('App\Customer');
    }
}
