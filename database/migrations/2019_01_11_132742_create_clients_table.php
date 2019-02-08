<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_name')->nullable();
            $table->string('street')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('ui_language')->nullable();
            $table->string('email_value')->nullable();
            $table->string('email_name')->nullable();
            $table->string('phone_value')->nullable();
            $table->string('phone_name')->nullable();
            $table->string('client_note')->nullable();
            $table->string('company')->nullable();
            $table->string('client_group')->nullable();
            $table->string('nationalID')->nullable();
            $table->string('signature')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
