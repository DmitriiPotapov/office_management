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
            $table->string('brand', 100)->nullable()->default('Western Digital');
            $table->string('role', 100)->nullable();
            $table->string('manufacturer', 100)->nullable();
            $table->string('capacity', 100)->default('4GB');
            $table->string('model', 100)->nullable();
            $table->string('dom', 100)->nullable()->default('27 June 2010');
            $table->string('platter_head', 100)->nullable()->default('3/6');
            $table->string('made_in', 100)->nullable()->default('Philippines');
            $table->string('PCB', 100)->nullable()->default('OK');
            $table->string('motor', 100)->nullable()->default('OK');
            $table->string('firmware', 100)->nullable()->default('NA');
            $table->string('encryption', 100)->nullable()->default('NA');
            $table->string('heads', 100)->nullable()->default('DAMAGED');
            $table->string('serial', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->text('diagnosis', 100)->nullable()->default('not set');
            $table->text('consultation')->nullable();
            $table->text('recover')->nullable();
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
