<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';

    protected $fillable = ['responsible_person', 'phone', 'email', 'address', 'company', 'more_info'];

    public function customer_invoices(){
        return $this->hasMany('App\CustomerInvoice','customer_id');
    }

    public function customer_ledgers(){
        return $this->hasMany('App\CustomerLedger', 'customer_id');
    }
}
