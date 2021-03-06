<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_authors', function (Blueprint $table) {
            $table->integer('location_id')->unsigned();
            $table->integer('author_id')->unsigned();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade')->onUpdate('cascade'); // If I delete a location delete all references to it in location_author
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade')->onUpdate('cascade'); // If I delete an author delete all references to it in location_author
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_authors', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropForeign(['author_id']);
        });

        Schema::drop('location_authors');
    }
}