<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerInvoice extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'customer_invoices';
    protected $primaryKey = 'customer_invoice_id';

    protected $fillable = ['invoice_no', 'all_total', 'all_money', 'total_expense','date', 'more_info'];

    public function product_customers(){
        return $this->hasMany('App\ProductCustomer', 'customer_invoice_id');
    }

    public function customers(){
        return $this->belongsTo('App\Customer');
    }
}
