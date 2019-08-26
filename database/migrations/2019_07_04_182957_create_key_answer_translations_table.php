<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyAnswerTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_answer_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('key_answer_id')->unsigned();
            $table->string('locale')->index()->default('en');
            //----------fields for KEY ANSWER-------------
            $table->string('title')->nullable();
            //--------------------------------------

            $table->unique(['key_answer_id', 'locale']);
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
        Schema::dropIfExists('key_answer_translations');
    }
}