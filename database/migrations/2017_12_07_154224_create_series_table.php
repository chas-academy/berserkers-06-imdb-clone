<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table)
        {
            $table->integer('title_id')->unsigned();
            $table->string('title');
            $table->date('release_year');
            $table->date('end_date')->nullable();
            $table->text('plot_summary')->nullable();
            $table->text('countries');
            $table->string('pg_rating');
            $table->string('trailer')->nullable();
            $table->integer('num_of_seasons');
            $table->integer('num_of_episodes');
            $table->timestamps();

            $table->foreign('title_id')->references('id')->on('titles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series');
    }
}
