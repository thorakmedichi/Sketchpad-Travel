<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('map_id')->unsigned()->nullable();
            $table->decimal('lat', 9, 6);
            $table->decimal('lng', 8, 6);
            $table->string('name', 100);
            $table->mediumText('description')->nullable();
            $table->softDeletes();

            $table->foreign('image_id')->references('id')->on('image')->onDelete('set null')->onUpdate('cascade'); // When image is deleted set location.image_id null
            $table->foreign('country_id')->references('id')->on('country')->onDelete('cascade')->onUpdate('cascade'); // When country is deleted remove the location as well
            $table->foreign('map_id')->references('id')->on('map')->onDelete('set null')->onUpdate('cascade'); // When map is deleted set location.map_id null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropForeign(['country_id']);
        });

        Schema::drop('location');
    }
}