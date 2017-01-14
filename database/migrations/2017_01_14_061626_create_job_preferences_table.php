<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->integer('workplace_1_id')->unsigned();
            $table->integer('workplace_2_id')->unsigned();
            $table->integer('workplace_3_id')->unsigned();
            $table->integer('atmosphere_1_id')->unsigned();
            $table->integer('atmosphere_2_id')->unsigned();
            $table->integer('atmosphere_3_id')->unsigned();
            $table->integer('workenvironment_1_id')->unsigned();
            $table->integer('workenvironment_2_id')->unsigned();
            $table->integer('workenvironment_3_id')->unsigned();
            $table->integer('interaction_1_id')->unsigned();
            $table->integer('interaction_2_id')->unsigned();
            $table->integer('interaction_3_id')->unsigned();
            $table->integer('microculture_1_id')->unsigned();
            $table->integer('microculture_2_id')->unsigned();
            $table->integer('microculture_3_id')->unsigned();
            $table->timestamps();
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
        Schema::drop('job_preferences');
    }
}
