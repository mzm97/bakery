<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{

    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {

          $table->increments('employee_id');
         $table->string('employee_name')->nullable();
         $table->string('employee_phone')->nullable();
         $table->string('employee_email')->nullable();
         $table->string('employee_address')->nullable();
         $table->string('position')->nullable();
         $table->integer('salary')->nullable();
         $table->integer('remaining_salary')->nullable();
         $table->string('more_info')->nullable();
         $table->softDeletes();
         $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
