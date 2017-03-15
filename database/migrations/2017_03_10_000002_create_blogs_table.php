<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->enum('status', ['published', 'draft'])->nullable();
            $table->string('title', 255);
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade')->onUpdate('cascade'); // When author is deleted delete all blogs owned by them
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });

        Schema::drop('blogs');
    }
}