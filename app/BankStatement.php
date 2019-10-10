<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankStatement extends Model
{
  use SoftDeletes;
  public $timestamps = true;
  protected $table = 'bank_statements';
  protected $primaryKey = 'bank_statement_id';
  protected $fillable = ['date', 'Transection', 'amount'];

  public function banks(){
      return $this->belongsTo('App\Bank');
  }
}
