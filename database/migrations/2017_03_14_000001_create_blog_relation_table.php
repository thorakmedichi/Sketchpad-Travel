<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_relation', function (Blueprint $table) {
            $table->integer('blog_id')->unsigned();
            $table->integer('relation_id')->unsigned();
            $table->enum('type', ['trips', 'locations']);

            $table->unique(['blog_id', 'relation_id', 'type']);

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade')->onUpdate('cascade'); // When tag is deleted delete all references in tag_relation
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_relation', function (Blueprint $table) {
            $table->dropForeign(['blog_id']);
        });

        Schema::drop('blog_relation');
    }
}