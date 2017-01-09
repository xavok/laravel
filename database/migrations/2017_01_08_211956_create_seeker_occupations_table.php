<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeekerOccupationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('seeker_occupations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->integer('occupation_subtype_id')->unsigned();
            $table->integer('years')->unsigned();
            $table->timestamps();
            $table->foreign('profile_id')->references('id')->on('seeker_profiles');
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
        //
        Schema::drop('seeker_occupations');

    }
}
