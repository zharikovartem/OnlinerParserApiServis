<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRussianWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RussianWords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->text('name');
            $table->text('description')->nullable();
            $table->integer('occurrence')->nullable();
            $table->text('languige');

            $table->boolean('isBasic')->default(false);
            $table->boolean('isContain')->default(false);
            $table->text('gender')->nullable();
            $table->text('part_of_speech')->nullable();
            $table->text('word_number')->nullable();
            $table->text('conjugation')->nullable();
            $table->json('examples')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RussianWords');
    }
}
