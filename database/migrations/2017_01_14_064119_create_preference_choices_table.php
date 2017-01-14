<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferenceChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preference_choices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('preference_id')->unsigned();
            $table->integer('rank')->unsigned();
            $table->string('description');
            $table->timestamps();
            $table->foreign('preference_id')->references('id')->on('preferences');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('preference_choices');
    }
}
