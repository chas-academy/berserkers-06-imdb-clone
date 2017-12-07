<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerieGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('serie_genre', function (Blueprint $table) {
            $table->integer('serie_id')->unsigned();
            $table->integer('genre_id')->unsigned();

            $table->foreign('serie_id')->references('id')->on('series');
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('series_genres', function (Blueprint $table) {
            //
        });
    }
}
