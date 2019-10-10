<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RawSuppliers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_suppliers', function(Blueprint $table){
            $table->increments('raw_supplier_id');
            $table->integer('price')->nullable();
            $table->double('quantity')->nullable();
            $table->integer('total')->nullable();
            $table->unsignedInteger('raw_material_id');
            $table->unsignedInteger('supplier_invoice_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('raw_material_id')->references('raw_material_id')->on('raw_materials')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supplier_invoice_id')->references('supplier_invoice_id')->on('supplier_invoices')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_suppliers');
    }
}
