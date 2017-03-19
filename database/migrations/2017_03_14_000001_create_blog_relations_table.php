<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_relations', function (Blueprint $table) {
            $table->integer('blog_id')->unsigned();
            $table->integer('relation_id')->unsigned();
            $table->enum('type', ['trip', 'location']);

            $table->unique(['blog_id', 'relation_id', 'type']);

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade')->onUpdate('cascade'); // When tag is deleted delete all references in blog_relations
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_relations', function (Blueprint $table) {
            $table->dropForeign(['blog_id']);
        });

        Schema::drop('blog_relations');
    }
}