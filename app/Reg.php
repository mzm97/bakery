<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reg extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'regs';
    protected $primaryKey = 'reg_id';
    protected $fillable = ['days', 'reg_code'];

}
