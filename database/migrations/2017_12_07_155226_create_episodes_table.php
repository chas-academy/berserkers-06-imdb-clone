<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->integer('title_id')->unsigned();
            $table->integer('season_id')->unsigned();
            $table->string('name');
            $table->integer('episode_number');
            $table->text('plot_summary')->nullable();
            $table->date('air_date');

            $table->foreign('title_id')->references('id')->on('titles');
            $table->foreign('season_id')->references('title_id')->on('seasons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
