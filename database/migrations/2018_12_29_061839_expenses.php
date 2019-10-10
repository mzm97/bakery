<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Expenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function(Blueprint $table){
            $table->increments('expense_id');
            $table->string('date')->nullable();
            $table->integer('amount')->nullable();
            $table->string('description')->nullable();
            $table->unsignedInteger('expense_type_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('expense_type_id')->references('expense_type_id')->on('expense_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
