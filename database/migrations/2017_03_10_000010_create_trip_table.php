<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('map_id')->unsigned()->nullable();
            $table->string('name', 100);
            $table->date('start_date');
            $table->date('end_date');
            $table->mediumText('description')->nullable();
            $table->integer('map_id1')->unsigned();
            $table->softDeletes();

            $table->foreign('map_id')->references('id')->on('map')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('image_id')->references('id')->on('image')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trip', function (Blueprint $table) {
            $table->dropForeign(['map_id1']);
        });

        Schema::drop('trip');
    }
}