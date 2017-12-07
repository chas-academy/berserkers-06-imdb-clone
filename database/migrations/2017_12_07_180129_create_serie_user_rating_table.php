<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerieUserRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serie_user_rating', function (Blueprint $table) {
            $table->integer('serie_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('rating_id')->unsigned();

            $table->foreign('serie_id')->references('id')->on('series');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rating_id')->references('id')->on('ratings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serie_user_rating');
    }
}
