<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_customers', function(Blueprint $table){
            $table->increments('product_customer_id');
            $table->double('price')->nullable();
            $table->double('quantity')->nullable();
            $table->text('packs')->nullable();
            $table->integer('packsCount')->nullable();
            $table->integer('total')->nullable();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('customer_invoice_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('product_id')->references('product_id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customer_invoice_id')->references('customer_invoice_id')->on('customer_invoices')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_customers');
    }
}
