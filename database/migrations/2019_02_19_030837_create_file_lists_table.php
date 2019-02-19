<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id');
            $table->string('file_name', 100)->nullable();
            $table->string('uploaded_by', 100)->nullable();
            $table->bigInteger('size');
            $table->string('full_path', 100)->nullable();
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
        Schema::dropIfExists('file_lists');
    }
}
