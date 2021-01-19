<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->text('name');
            $table->longText('description')->nullable();
            $table->integer('user_id');
            $table->integer('tado_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->text('type')->nullable();
            // $table->text('date')->nullable();
            $table->date('date')->nullable();
            // $table->text('type')->nullable();
            $table->time('time')->nullable();
            $table->mediumText('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
