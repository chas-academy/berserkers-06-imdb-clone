<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerieCreatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('serie_person', function (Blueprint $table) {
            $table->integer('serie_id')->unsigned();
            $table->integer('person_id')->unsigned();

            $table->foreign('serie_id')->references('id')->on('series');
            $table->foreign('person_id')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episode_person');
    }
}
