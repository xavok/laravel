<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOccupationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_occupations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->integer('occupation_id')->unsigned();
            $table->integer('occupation_subtype_id')->unsigned();
            $table->integer('years')->unsigned();
            $table->timestamps();
            $table->foreign('job_id')->references('id')->on('job_profiles');
            $table->foreign('occupation_id')->references('id')->on('occupations');
            $table->foreign('occupation_subtype_id')->references('id')->on('occupation_subtypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('job_occupations');
    }
}
