<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_relations', function (Blueprint $table) {
            $table->integer('tag_id')->unsigned();
            $table->integer('tag_relation_id')->unsigned();
            $table->string('tag_relation_type');

            $table->unique(['tag_id', 'tag_relation_id', 'tag_relation_type'], 'unique_tag_relation_id');

            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade'); // When tag is deleted delete all references in tag_relations
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tag_relations');
    }
}