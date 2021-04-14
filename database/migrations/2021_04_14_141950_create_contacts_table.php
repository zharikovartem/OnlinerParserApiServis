<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("Contacts", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->text("name");
            $table->text("phone");
            $table->json("Skype")->nullable();
            $table->json("Viber")->nullable();
            $table->json("Telegram")->nullable();
            $table->json("WhatsApp")->nullable();

            $table->unsignedBigInteger("providerId")->nullable();
            $table->foreign('providerId')
                    ->references('id')->on('Providers')
                    ->onDelete('cascade');

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
        Schema::dropIfExists("Contacts");
    }
}
