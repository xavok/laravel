<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeekerIndustries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('seeker_industries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->integer('industry_id')->unsigned();
            $table->integer('years')->unsigned();
            $table->timestamps();
            $table->foreign('profile_id')->references('id')->on('seeker_profiles');
            $table->foreign('industry_id')->references('id')->on('industries');
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
        Schema::drop('seeker_industries');
    }
}
