<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierInvoice extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'supplier_invoices';
    protected $primaryKey = 'supplier_invoice_id';

    protected $fillable = [
        'supplier_invoice_no', 'date', 'all_total', 'other_expense', 'all_money', 'more_info'
    ];

    public function suppliers(){
        return $this->belongsTo('App\Supplier');
    }

    public function raw_suppliers(){
        return $this->hasMany('App\RawSupplier','supplier_invoice_id');
    }
}
