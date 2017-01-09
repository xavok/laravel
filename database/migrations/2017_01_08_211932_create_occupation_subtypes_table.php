<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOccupationSubtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('occupation_subtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('occupation_id')->unsigned();
            $table->string('occupation_subtype_name');
            $table->timestamps();
            $table->foreign('occupation_id')->references('id')->on('occupations');
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
        Schema::drop('occupation_subtypes');

    }
}
