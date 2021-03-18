<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControllerMethodsTable extends Migration
{
    public function up()
    {
        Schema::create("ControllerMethods", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("controller_id");
            $table->text("name");
            $table->json("request")->nullable();
            $table->json("response")->nullable();
            $table->text("rest_type");
            $table->boolean("isMiddleware")->nullable();
            $table->text("body_actions")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("ControllerMethods");
    }
}