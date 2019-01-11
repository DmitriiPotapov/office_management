<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('user_name', 191);
            $table->integer('job_id')->unsigned();
            $table->integer('job_password')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->string('client_name', 100)->nullable();
            $table->integer('price')->default(0);
            $table->string('status', 100)->nullable()->default('Received');
            $table->string('services', 100)->nullable()->default('Data Recovery');
            $table->string('priority', 100)->nullable();
            $table->string('assigned_engineer')->nullable()->default('Not assigned');
            $table->text('device_malfunc_info')->nullable();
            $table->text('important_data')->nullable();
            $table->text('notes')->nullable();
            $table->text('last_comment')->nullable();
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
        Schema::dropIfExists('data_jobs');
    }
}
