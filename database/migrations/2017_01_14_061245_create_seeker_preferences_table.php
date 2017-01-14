<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeekerPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeker_preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->integer('workplace_1_id')->unsigned();
            $table->integer('workplace_2_id')->unsigned();
            $table->integer('workplace_3_id')->unsigned();
            $table->integer('atmosphere_1_id')->unsigned();
            $table->integer('atmosphere_2_id')->unsigned();
            $table->integer('atmosphere_3_id')->unsigned();
            $table->integer('work_environment_1_id')->unsigned();
            $table->integer('work_environment_2_id')->unsigned();
            $table->integer('work_environment_3_id')->unsigned();
            $table->integer('interaction_1_id')->unsigned();
            $table->integer('interaction_2_id')->unsigned();
            $table->integer('interaction_3_id')->unsigned();
            $table->integer('microculture_1_id')->unsigned();
            $table->integer('microculture_2_id')->unsigned();
            $table->integer('microculture_3_id')->unsigned();
            $table->timestamps();
            $table->foreign('profile_id')->references('id')->on('seeker_profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seeker_preferences');
    }
}
