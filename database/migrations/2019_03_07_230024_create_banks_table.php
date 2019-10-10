<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{

    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {

          $table->increments('bank_id');
          $table->string('bank_name')->nullable();
          $table->string('account_name')->nullable();
          $table->string('account_no')->nullable();
          $table->softDeletes();
          $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
