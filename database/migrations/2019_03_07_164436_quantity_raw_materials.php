<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuantityRawMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantity_raw_materials', function(Blueprint $table){
            $table->increments('quantity_raw_material_id');
            $table->string('add_remove')->null();
            $table->integer('quantity')->null();
            $table->integer('existent_quantity')->null();
            $table->string('date')->null();
            $table->text('more_info')->null();
            $table->unsignedInteger('raw_material_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('raw_material_id')->references('raw_material_id')->on('raw_materials')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quantity_raw_materials');
    }
}
