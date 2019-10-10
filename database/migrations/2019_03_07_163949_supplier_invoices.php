<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SupplierInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_invoices', function(Blueprint $table){
            $table->increments('supplier_invoice_id');
            $table->string('supplier_invoice_no')->null();
            $table->string('date')->null();
            $table->integer('all_total')->null();
            $table->integer('other_expense')->null();
            $table->integer('all_money')->null();
            $table->string('more_info')->null();
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
        Schema::dropIfExists('supplier_invoices');
    }
}
