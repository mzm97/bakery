<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_invoices', function(Blueprint $table){
            $table->increments('customer_invoice_id');
            $table->string('customer_invoice_no')->nullable();
            $table->string('date')->nullable();
            $table->integer('all_total')->nullable();
            $table->integer('other_expense')->nullable();
            $table->integer('all_money')->nullable();
            $table->integer('tax')->nullable();
            $table->string('more_info')->nullable();
            $table->unsignedInteger('customer_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_invoices');
    }
}
