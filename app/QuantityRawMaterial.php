<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuantityRawMaterial extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'quantity_raw_materials';
    protected $primaryKey = 'quantity_raw_material_id';

    protected $fillable = [
        'add_remove', 'quantity', 'existent_quantity', 'date', 'description'
    ];

    public function raw_materials(){
        return $this->belongsTo('App\RawMaterial');
    }
}
