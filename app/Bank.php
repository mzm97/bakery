<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{

  use SoftDeletes;
  public $timestamps = true;
  protected $table = 'banks';
  protected $primaryKey = 'bank_id';
  protected $fillable = ['bank_name', 'account_name', 'account_no'];

  public function bank_statements(){
      return $this->hasMany('App\BankStatement', 'bank_id');
  }
}
