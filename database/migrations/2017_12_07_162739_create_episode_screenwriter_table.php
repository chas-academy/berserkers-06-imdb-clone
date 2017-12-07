<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodeScreenwriterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('episode_screenwriter', function (Blueprint $table) {
            
            $table->integer('episode_id')->unsigned();
            $table->integer('person_id')->unsigned();

            $table->foreign('episode_id')->references('id')->on('episodes');
            $table->foreign('person_id')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('episodes_screenwriters', function (Blueprint $table) {
            //
        });
    }
}
