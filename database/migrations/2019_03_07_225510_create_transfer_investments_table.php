<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferInvestmentsTable extends Migration
{

    public function up()
    {
        Schema::create('transfer_investments', function (Blueprint $table) {
          $table->increments('transfer_investment_id');
          $table->string('date')->nullable();
          $table->string('source')->nullable();
          $table->integer('amount')->nullable();
          $table->string('add_remove')->nullable();
          $table->integer('balance')->nullable();
          $table->string('description')->nullable();
          $table->softDeletes();
          $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('transfer_investments');
    }
}
