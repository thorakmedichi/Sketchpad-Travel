<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->enum('status', ['published', 'draft'])->nullable();
            $table->string('title', 255);
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->softDeletes();

            $table->foreign('author_id')->references('id')->on('author')->onDelete('cascade')->onUpdate('cascade'); // When author is deleted delete all blogs owned by them
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });

        Schema::drop('blog');
    }
}