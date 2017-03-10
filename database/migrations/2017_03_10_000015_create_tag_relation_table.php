<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_relation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned();
            $table->integer('related_id')->unsigned();
            $table->enum('type', ['image', 'trip', 'location', 'blog']);

            $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascade')->onUpdate('cascade'); // When tag is deleted delete all references in tag_relation
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tag_relation', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
        });

        Schema::drop('tag_relation');
    }
}