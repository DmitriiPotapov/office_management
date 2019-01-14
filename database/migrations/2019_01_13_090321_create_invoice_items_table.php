<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_id')->nullable();
            $table->string('type')->nullable();
            $table->string('text')->nullable();
            $table->string('price')->nullable();
            $table->string('VAT')->nullable();
            $table->string('disaccount')->nullable();
            $table->string('total_price')->nullable();
            $table->string('merge')->nullable();
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
        Schema::dropIfExists('invoice_items');
    }
}
