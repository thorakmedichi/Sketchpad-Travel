<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_location', function (Blueprint $table) {
            $table->integer('trip_id')->unsigned();
            $table->integer('location_id')->unsigned();

            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade')->onUpdate('cascade'); // When trip is deleted delete all references in trip_location
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade')->onUpdate('cascade'); // When location is deleted delete all references in trip_location
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trip_location', function (Blueprint $table) {
            $table->dropForeign(['trip_id']);
            $table->dropForeign(['location_id']);
        });

        Schema::drop('trip_location');
    }
}