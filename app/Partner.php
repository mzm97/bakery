<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'partners';
    protected $primaryKey = 'partner_id';

    protected $fillable = ['name', 'phone', 'email' , 'more_info'];

    public function withdraws(){
        return $this->hasMany('App\Withdraw', 'partner_id');
    }
}
