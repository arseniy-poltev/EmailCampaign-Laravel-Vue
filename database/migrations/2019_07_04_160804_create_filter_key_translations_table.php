<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilterKeyTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_key_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('filter_key_id')->unsigned();
            $table->string('locale')->index()->default('en');
            //----------fields for FILTER KEY-------------
            $table->string('name')->nullable();
            //--------------------------------------

            $table->unique(['filter_key_id', 'locale']);
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
        Schema::dropIfExists('filter_key_translations');
    }
}