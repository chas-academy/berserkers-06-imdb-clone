<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitleListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('title_lists', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('title_id')->unsigned();
            $table->integer('user_list_id')->unsigned();
            $table->integer('list_index')->unsigned();

            $table->foreign('title_id')->references('id')->on('titles');
            $table->foreign('user_list_id')->references('id')->on('user_lists');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
