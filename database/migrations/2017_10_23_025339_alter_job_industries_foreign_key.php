<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterJobIndustriesForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_industries', function (Blueprint $table) {
            $table->dropForeign('job_industries_id_foreign');
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
        Schema::table('job_industries', function (Blueprint $table) {
            $table->dropForeign('job_industries_job_id_foreign');
            $table->foreign('id')->references('id')->on('job_profiles');
        });
    }
}
