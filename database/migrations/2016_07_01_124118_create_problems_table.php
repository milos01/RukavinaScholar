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
      Schema::create('problem_categories', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->timestamps();
          $table->softDeletes();
      });
      Schema::create('problems', function(Blueprint $table){
            $table->increments('id');
            $table->string('subject');
            $table->integer('person_from')->unsigned();
            $table->foreign('person_from')->references('id')->on('users');
            $table->integer('main_slovler')->unsigned();
            $table->foreign('main_slovler')->references('id')->on('users');
            $table->integer('problem_type')->unsigned();
            $table->foreign('problem_type')->references('id')->on('problem_categories');
            $table->longText('problem_description');
            $table->longText('solution_description');
            $table->integer('took')->unsigned();
            $table->integer('waiting')->unsigned();
            $table->boolean('inactive');
            $table->boolean('paid');
            $table->timestamps();
            $table->timestamp('time_ends_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('problem_categories');
      Schema::drop('problems');
    }
}
