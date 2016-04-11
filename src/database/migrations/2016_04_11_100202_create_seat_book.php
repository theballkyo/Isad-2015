<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_book', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('course_user_id')->unsigned();
            $table->foreign('course_user_id')->references('id')->on('course_user')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seat_book', function (Blueprint $table) {
            //
        });
    }
}
