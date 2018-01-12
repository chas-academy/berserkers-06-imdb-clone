<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->integer('title_id')->unsigned();
            $table->string('title');
            $table->date('release_year');
            $table->text('plot_summary')->nullable();
            $table->integer('runtime')->unsigned()->nullable();
            $table->text('countries');
            $table->string('pg_rating')->nullable();
            $table->text('trailer')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
