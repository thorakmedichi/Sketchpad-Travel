<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map', function (Blueprint $table) {
            $table->increments('id');
            $table->string('klm_file', 256)->nullable();
            $table->decimal('sw_bounds', 9, 6)->nullable();
            $table->decimal('ne_bounds', 9, 6)->nullable();
            $table->softDeletes();
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
            $table->dropForeign(['map_id']);
        });

        Schema::drop('map');
    }
}