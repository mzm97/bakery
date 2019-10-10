<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $fillable = ['product_name', 'product_type', 'estimated_price','more_info'];

    public function product_customers(){
        return $this->hasMany('App\ProductCustomer','product_id');
    }

    public function quantity_products(){
        return $this->hasMany('App\QuantityProduct','product_id');
    }
}
