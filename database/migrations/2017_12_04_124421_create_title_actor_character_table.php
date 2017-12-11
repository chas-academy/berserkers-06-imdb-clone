<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitleActorCharacterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('title_actor_character', function (Blueprint $table) {
            $table->integer('title_id')->unsigned();
            $table->integer('person_id')->unsigned();
            $table->integer('character_id')->unsigned();

            $table->foreign('title_id')->references('id')->on('titles');
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('character_id')->references('id')->on('characters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('title_actor_character');
    }
}
