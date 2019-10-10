<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';

    protected $fillable = [
        'responsible_person', 'phone', 'email', 'address', 'company', 'more_info'
    ];

    public function supplier_invoices(){
        return $this->hasMany('App\SupplierInvoice','supplier_id');
    }

    public function supplier_ledgers(){
        return $this->hasMany('App\SupplierLedger','supplier_id');
    }
}
