<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataJobHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_job_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->string('user_name', 100)->nullable();
            $table->string('client_name', 100)->nullable();
            $table->string('job_priority', 100)->nullable();
            $table->string('job_status', 100)->nullable();
            $table->string('job_info', 100)->nullable();
            $table->string('important_data', 100)->nullable();
            $table->string('assigned_to', 100)->nullable();
            $table->string('comment', 100)->nullable();
            $table->string('client_info', 100)->nullable();
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
        Schema::dropIfExists('data_job_histories');
    }
}
