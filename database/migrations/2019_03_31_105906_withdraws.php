<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Withdraws extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws',function(Blueprint $table){
            $table->increments('withdraw_id');
            $table->string('date')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('balance')->nullable();
            $table->string('more_info')->nullable();
            $table->unsignedInteger('partner_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('partner_id')->references('partner_id')->on('partners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraws');
    }
}
