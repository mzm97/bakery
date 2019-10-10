<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuantityProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantity_products',function(Blueprint $table){
            $table->increments('quantity_product_id');
            $table->string('add_remove')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('existent_quantity')->nullable();
            $table->string('date')->nullable();
            $table->string('more_info')->nullable();
            $table->unsignedInteger('product_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quantity_products');
    }
}
