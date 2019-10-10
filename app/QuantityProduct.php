<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuantityProduct extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'quantity_products';
    protected $primaryKey = 'quantity_product_id';

    protected $fillable = ['add_remove', 'quantity', 'date', 'more_info'];

    public function products(){
        return $this->belongsTo('App\Product');
    }
}
