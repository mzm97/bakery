<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterial extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'raw_materials';
    protected $primaryKey = 'raw_material_id';

    protected $fillable = [
        'raw_material_name', 'raw_material_type','estimated_price','unit','existent_quantity', 'more_info'
    ];

    public function raw_suppliers(){
        return $this->hasMany('App\RawSupplier','raw_material_id');
    }

    public function quantity_raw_materials(){
        return $this->hasMany('App\QuantityRawMaterial','raw_material_id');
    }
}
