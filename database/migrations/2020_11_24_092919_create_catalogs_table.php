<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Catalog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name');
            $table->boolean('is_active')->nullable();
            $table->integer('total_count')->nullable();
            $table->integer('descriptions_count')->nullable();
            $table->integer('parent_id');
            $table->string('label');
            // $table->json('params')->nullable();
            $table->longText('params')->nullable();
            $table->string('labels')->nullable();
            $table->string('type')->nullable();
            $table->mediumText('url')->nullable();
            $table->mediumText('full_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogs');
    }
}
