<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('image_id')->unsigned()->nullable();
            $table->string('email', 100)->nullable();
            $table->mediumText('bio')->nullable();
            $table->smallInteger('age')->nullable();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade'); // When user is deleted delete the author as well
            $table->foreign('image_id')->references('id')->on('image')->onDelete('set null')->onUpdate('cascade'); // When user is deleted set author.image_id to null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('author');
    }
}