<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCustomer extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'product_customers';
    protected $primaryKey = 'product_customer_id';

    protected $fillable = ['price', 'quantity', 'total', 'more_info'];

    public function products(){
        return $this->belongsTo('App\Product');
    }

    public function customer_invoices(){
        return $this->belongsTo('App\CustomerInvoice');
    }

//    public function quantity_product_parts(){
//            return $this->hasMany('App\QuantityProductPart','product_customer_id');
//    }
}
