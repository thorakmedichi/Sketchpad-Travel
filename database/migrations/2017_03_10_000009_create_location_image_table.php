<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_image', function (Blueprint $table) {
            $table->integer('location_id')->unsigned();
            $table->integer('image_id')->unsigned();
            $table->tinyInteger('order');

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_image', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropForeign(['image_id']);
        });

        Schema::drop('location_image');
    }
}