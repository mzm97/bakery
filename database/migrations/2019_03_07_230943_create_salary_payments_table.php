<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryPaymentsTable extends Migration
{

    public function up()
    {
        Schema::create('salary_payments', function (Blueprint $table) {

            $table->increments('salary_payment_id');
            $table->integer('absence_quantity')->nullable();
            $table->integer('over_time')->nullable();
            $table->integer('old_balance')->nullable();
            $table->integer('advance')->nullable();
            $table->integer('giving_amount')->nullable();
            $table->unsignedInteger('employee_id');
            $table->string('date');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('employee_id')->references('employee_id')->on('employees');

        });
    }


    public function down()
    {
        Schema::dropIfExists('salary_payments');
    }
}
