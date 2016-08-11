<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_from')->unsigned();
            $table->foreign('user_from')->references('id')->on('users');
            $table->integer('user_to')->unsigned();
            $table->foreign('user_to')->references('id')->on('users');
            $table->integer('read')->unsigned();
            $table->integer('last')->unsigned();
            $table->integer('group_start')->unsigned();
            $table->integer('group_end')->unsigned();
            $table->string('message');
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
        Schema::drop('messages');
    }
}
