<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitleUserRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('title_user_rating', function (Blueprint $table)
        {
            $table->integer('title_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('rating_id')->unsigned();

            $table->foreign('title_id')->references('id')->on('titles');
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
        Schema::dropIfExists('title_user_rating');
    }
}
