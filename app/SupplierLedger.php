<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierLedger extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'supplier_ledgers';
    protected $primaryKey = 'supplier_ledger_id';

    protected $fillable = ['date', 'purchase', 'giving_money', 'balance', 'more_info'];

    public function suppliers(){
        return $this->belongsTo('App\Supplier');
    }
}
