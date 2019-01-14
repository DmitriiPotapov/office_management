<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned()->nullable();
            $table->string('acquire_from', 100)->nullable();
            $table->string('inventory_id', 100)->nullable();
            $table->string('manufacturer', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('serial_number', 100)->nullable();
            $table->string('firmware', 100)->nullable();
            $table->integer('job_id')->unsigned()->nullable();
            $table->string('PCB_state', 100)->nullable();
            $table->string('family', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->string('Form_factor', 100)->nullable();
            $table->string('note', 100)->nullable();
            $table->integer('heads_number')->unsigned()->nullable();
            $table->string('heads_info', 100)->nullable();
            $table->string('role', 100)->nullable();
            $table->string('active', 100)->nullable();
            $table->string('busy', 100)->nullable();
            $table->string('resources', 100)->nullable();
            $table->string('device_type', 100)->nullable();
            $table->integer('part_number')->unsigned()->nullable();
            $table->integer('LBA_number')->unsigned()->nullable();
            $table->integer('PCB_id')->unsigned()->nullable();
            $table->string('PCB_controller', 100)->nullable();
            $table->string('PCB_motor_driver', 100)->nullable();
            $table->string('PCB_connection', 100)->nullable();
            $table->string('RPM', 100)->nullable();
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
        Schema::dropIfExists('data_inventories');
    }
}
