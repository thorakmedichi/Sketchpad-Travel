<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripAuthorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_author', function (Blueprint $table) {
            $table->integer('trip_id')->unsigned();
            $table->integer('author_id')->unsigned();

            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade')->onUpdate('cascade'); // When trip is deleted delete all references in trip_author
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade')->onUpdate('cascade'); // When author is deleted delete all references in trip_author
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trip_author', function (Blueprint $table) {
            $table->dropForeign(['trip_id']);
            $table->dropForeign(['author_id']);
        });

        Schema::drop('trip_author');
    }
}