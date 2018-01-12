<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitleGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('title_genre', function (Blueprint $table) {
            $table->integer('title_id')->unsigned();
            $table->integer('genre_id')->unsigned();

            // Sets column 'title_id' to be a foreign key to the primary key 'id' in the titles table
            $table->foreign('title_id')->references('id')->on('titles');

            // Sets column 'genre_id' to be a foreign key to the primary key 'id' in the genres table
            $table->foreign('genre_id')->references('id')->on('genres');

            // Sets the combination of 'title_id' + 'genre_id' to be the primary key of this 
            $table->primary(['title_id', 'genre_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('title_genre');
    }
}
