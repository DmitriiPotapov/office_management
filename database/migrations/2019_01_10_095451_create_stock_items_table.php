<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('device_type')->nullable();
            $table->string('connection')->nullable();
            $table->string('form_factor')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('stock_model')->nullable();
            $table->string('location')->nullable();
            $table->string('diler_info')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('input_price')->nullable();
            $table->string('vat_value')->nullable();
            $table->string('interest')->nullable();
            $table->string('final_price')->nullable();
            $table->string('stock_note')->nullable();
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
        Schema::dropIfExists('stock_items');
    }
}
