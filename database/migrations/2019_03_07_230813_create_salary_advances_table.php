<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryAdvancesTable extends Migration
{

    public function up()
    {
        Schema::create('salary_advances', function (Blueprint $table) {
            $table->increments('salary_advance_id');
            $table->integer('advance_money')->nullable();
            $table->unsignedInteger('employee_id');
            $table->string('date');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('employee_id')->references('employee_id')->on('employees');
        });
    }


    public function down()
    {
        Schema::dropIfExists('salary_advances');
    }
}
