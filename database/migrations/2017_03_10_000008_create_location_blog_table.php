<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_blog', function (Blueprint $table) {
            $table->integer('location_id')->unsigned();
            $table->integer('blog_id')->unsigned();

            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade'); // If I delete a location kill all references to it in this table
            $table->foreign('blog_id')->references('id')->on('blog')->onDelete('cascade')->onUpdate('cascade'); // If I delete a blog kill all references to it in this table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_blog', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropForeign(['blog_id']);
        });

        Schema::drop('location_blog');
    }
}