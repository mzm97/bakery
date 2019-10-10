<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RawMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_materials', function(Blueprint $table){
            $table->increments('raw_material_id');
            $table->string('raw_material_name')->nullable();
            $table->string('raw_material_type')->nullable();
            $table->string('estimated_price')->nullable();
            $table->string('unit')->nullable();
            $table->string('existent_quantity')->nullable();
            $table->string('more_info')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_materials');
    }
}
