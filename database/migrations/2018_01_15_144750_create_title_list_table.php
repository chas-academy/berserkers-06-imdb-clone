<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitleListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('title_list', function (Blueprint $table) {
            $table->integer('title_id')->unsigned();
            $table->integer('user_list_id')->unsigned();

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
