<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOverTimesTable extends Migration
{

    public function up()
    {
        Schema::create('over_times', function (Blueprint $table) {

            $table->increments('over_time_id');
            $table->integer('over_time_money')->nullable();
            $table->unsignedInteger('employee_id');
            $table->string('date');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('employee_id')->references('employee_id')->on('employees');
        });
    }


    public function down()
    {
        Schema::dropIfExists('over_times');
    }
}
