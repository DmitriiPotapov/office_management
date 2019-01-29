<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_id')->nullable();
            $table->string('job_id')->nullable(); 
            $table->string('client_name')->nullable();
            $table->string('service')->nullable();
            $table->string('invoice_language')->nullable();
            $table->string('currency')->nullable();
            $table->string('item_type')->nullable();
            $table->string('item_capacity')->nullable();
            $table->string('item_price')->nullable();
            $table->string('item_vat')->nullable();
            $table->string('item_disaccount')->nullable();
            $table->string('item_total_price')->nullable();
            $table->string('invoice_note')->nullable();
            $table->string('status')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
