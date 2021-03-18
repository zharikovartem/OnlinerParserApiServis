<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontendsTable extends Migration
{
    public function up()
    {
        Schema::create("Frontend", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->text("name");
            $table->json("src_tree")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("Frontend");
    }
}