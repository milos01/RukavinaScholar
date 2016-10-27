<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function(Blueprint $table){
            $table->increments('id');
            $table->string('subject');
            $table->integer('person_from')->unsigned();
            $table->foreign('person_from')->references('id')->on('users');
            $table->integer('main_slovler')->unsigned();
            $table->foreign('main_slovler')->references('id')->on('users');
            $table->string('problem_type');
            $table->string('problem_description');
            $table->integer('took')->unsigned();
            $table->integer('waiting')->unsigned();
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
        Schema::drop('problems');
    }
}
