<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investment extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'investments';
    protected $primaryKey = 'investment_id';

    protected $fillable = ['amount'];
}
