<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_images', function (Blueprint $table) {
            $table->integer('trip_id')->unsigned();
            $table->integer('image_id')->unsigned();
            $table->integer('order')->unsigned();

            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade')->onUpdate('cascade'); // When trip is deleted delete all references in trip_images
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade')->onUpdate('cascade'); // When image is deleted delete all references in trip_images
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trip_images', function (Blueprint $table) {
            $table->dropForeign(['trip_id']);
            $table->dropForeign(['image_id']);
        });

        Schema::drop('trip_images');
    }
}