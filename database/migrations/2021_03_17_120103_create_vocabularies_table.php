<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVocabulariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("Vocabulary", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->text("eng_value");
            $table->text("rus_value");
            $table->text("part_of_speech");
            $table->text("gender");
            $table->boolean("is_irregular_verb")->nullable();
            $table->text("yandex_url")->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('Vocabulary');
    }
}
