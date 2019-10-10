<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankStatementsTable extends Migration
{

    public function up()
    {
        Schema::create('bank_statements', function (Blueprint $table) {

          $table->increments('bank_statement_id');
          $table->string('date')->nullable();
          $table->string('transection')->nullable();
          $table->integer('amount')->nullable();
          $table->integer('balance')->nullable();
          $table->unsignedInteger('bank_id');
          $table->softDeletes();
          $table->timestamps();
          $table->foreign('bank_id')->references('bank_id')->on('banks')->onUpdate('cascade')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('bank_statements');
    }
}
