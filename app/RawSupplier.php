<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawSupplier extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'raw_suppliers';
    protected $primaryKey = 'raw_supplier_id';

    protected $fillable = ['price', 'quantity', 'total', 'more_info'];

    public function raw_materials(){
        return $this->belongsTo('App\RawMaterial');
    }

    public function supplier_invoices(){
        return $this->belongsTo('App\SupplierInvoice');
    }
}
