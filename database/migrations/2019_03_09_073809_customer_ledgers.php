<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerLedgers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_ledgers', function (Blueprint $table){
            $table->increments('customer_ledger_id');
            $table->string('date')->nullable();
            $table->string('type')->nullable();
            $table->integer('sale')->nullable();
            $table->integer('extra_expense')->nullable();
            $table->integer('total')->nullable();
            $table->integer('received_debt')->nullable();
            $table->integer('balance')->nullable();
            $table->string('more_info')->nullable();
            $table->unsignedInteger('customer_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('customer_id')->references('customer_id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_ledgers');
    }
}
