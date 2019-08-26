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
            $table->string('invoice_number');
            $table->integer('campaign_id');
            $table->integer('user_id');
            $table->float('total_price');
            $table->integer('count_customers');
            $table->float('initial_price');
            $table->float('extra_price');
            $table->string('currency_code');
            $table->string('currency_symbol');
            $table->integer('extra_filter_count');
            $table->boolean('status')->default(false);
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