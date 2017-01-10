<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeekerEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeker_education', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->string('school');
            $table->integer('education_level_id')->unsigned();
            $table->integer('study_field_id')->unsigned();
            $table->date('graduation_date');
            $table->timestamps();
            $table->foreign('profile_id')->references('id')->on('seeker_profiles');
            $table->foreign('education_level_id')->references('id')->on('education_levels');
            $table->foreign('study_field_id')->references('id')->on('study_fields');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seeker_education');
    }
}
