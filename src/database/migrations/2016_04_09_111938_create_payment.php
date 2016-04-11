<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');

            //$table->integer('course_id')->unsigned();
            //$table->integer('user_id')->unsigned();

            $table->integer('course_user_id')->unsigned();
            $table->foreign('course_user_id')->references('id')->on('course_user')->onDelete('restrict');

            $table->string('img_name');
            $table->string('note');
            $table->integer('status');
            $table->timestamp('created_at');

            //$table->foreign('user_id')->references('user_id')->on('course_user');
            //$table->foreign('course_id')->references('course_id')->on('course_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function($table){
            $table->dropForeign(['course_id', 'user_id']);
        });

        Schema::drop('payments');
    }
}
