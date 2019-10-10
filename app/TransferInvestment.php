<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferInvestment extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'transfer_investments';
    protected $primaryKey = 'transfer_investment_id';

    protected $fillable = [
        'date', 'amount', 'description'
    ];
}
