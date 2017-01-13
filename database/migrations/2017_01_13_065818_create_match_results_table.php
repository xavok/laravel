<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('match_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->integer('rank')->unsigned();
            $table->integer('match_of')->unsigned();
            $table->integer('quality')->unsigned();
            $table->integer('personality')->unsigned();
            $table->integer('culture')->unsigned();
            $table->integer('qualification')->unsigned();
            $table->timestamps();
            $table->foreign('profile_id')->references('id')->on('seeker_profiles');
            $table->foreign('job_id')->references('id')->on('job_profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('match_results');
    }
}
