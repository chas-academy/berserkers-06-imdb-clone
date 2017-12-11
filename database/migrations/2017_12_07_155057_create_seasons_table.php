<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {

            $table->integer('title_id')->unsigned();
            $table->integer('series_id')->unsigned();
            $table->integer('season_number');
        
            $table->foreign('title_id')->references('id')->on('titles');
            $table->foreign('series_id')->references('title_id')->on('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}
