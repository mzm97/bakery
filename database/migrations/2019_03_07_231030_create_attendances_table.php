<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{

    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {

          $table->increments('attendance_id');
          $table->string('attendance_status')->nullable();
          $table->string('attendance_date')->nullable();
          $table->unsignedInteger('employee_id');
          $table->softDeletes();
          $table->timestamps();
          $table->foreign('employee_id')->references('employee_id')->on('employees');

        });
    }


    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
