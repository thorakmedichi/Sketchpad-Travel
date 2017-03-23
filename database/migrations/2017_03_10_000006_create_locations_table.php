<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256);
            $table->string('country_id', 2);
            $table->date('visit_date');
            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('map_id')->unsigned()->nullable();
            $table->mediumText('description')->nullable();
            $table->string('google_place_id', 255)->nullable();
            $table->decimal('lat', 9, 6);
            $table->decimal('lng', 10, 6);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null')->onUpdate('cascade'); // When image is deleted set location.image_id null
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade'); // When country is deleted remove the location as well
            $table->foreign('map_id')->references('id')->on('maps')->onDelete('set null')->onUpdate('cascade'); // When map is deleted set location.map_id null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['map_id']);
        });

        Schema::drop('locations');
    }
}