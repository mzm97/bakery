<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SupplierLedgers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_ledgers', function (Blueprint $table){
            $table->increments('supplier_ledger_id');
            $table->string('date')->nullable();
            $table->integer('purchase')->nullable();
            $table->integer('giving_money')->nullable();
            $table->integer('balance')->nullable();
            $table->string('more_info')->nullable();
            $table->unsignedInteger('supplier_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_ledgers');
    }
}
