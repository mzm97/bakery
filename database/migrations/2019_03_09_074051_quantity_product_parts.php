<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuantityProductParts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('quantity_product_parts', function (Blueprint $table){
//            $table->increments('quantity_product_part_id');
//            $table->integer('part_quantity')->nullable();
//            $table->unsignedInteger('product_customer_id');
//            $table->softDeletes();
//            $table->timestamps();
//            $table->foreign('product_customer_id')->references('product_customer_id')->on('product_customers');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('quantity_product_parts');
    }
}
