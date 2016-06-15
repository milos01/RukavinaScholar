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
            $table->integer('person_name')->unsigned();
            $table->foreign('person_name')->references('id')->on('users');
            $table->string('problem_description');
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
