<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnglishRussianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('english_word_russian_word', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('english_word_id');
            $table->unsignedBigInteger('russian_word_id');
            $table->foreign('english_word_id')->references('id')->on('EngleshWords');
            $table->foreign('russian_word_id')->references('id')->on('RussianWords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('english_word_russian_word');
    }
}
