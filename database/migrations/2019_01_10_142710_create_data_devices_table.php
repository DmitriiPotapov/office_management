<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->string('type', 100)->nullable();
            $table->string('role', 100)->nullable();
            $table->string('manufacturer', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('serial', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->string('diagnosis', 100)->nullable()->default('not set');
            $table->string('note', 100)->nullable();
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
        Schema::dropIfExists('data_devices');
    }
}
