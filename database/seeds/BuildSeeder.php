<?php

use Illuminate\Database\Seeder;

class BuildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('countries')->insert([
            'name' => 'Canada',
        ]);

        DB::table('authors')->insert([
            'user_id' => '1',
            'image_id' => null,
            'name' => 'Thorak',
            'email' => 'ryan@sketchpad-media.com',
            'bio' => 'Ryan has traveled a lot',
            'age' => '39'
        ]);


        /**
         * Location blog setup
         */
        DB::table('blogs')->insert([
            'author_id' => '1',
            'status' => 'published',
            'title' => 'Test Location blog',
            'excerpt' => 'Some excerpt comment',
            'content' => 'This is the main body of text for the blog'
        ]);

        // Location with a blog
        DB::table('blog_relation')->insert([
            'blog_id' => '1',
            'relation_id' => '1',
            'type' => 'locations'
        ]);

        DB::table('locations')->insert([
            'country_id' => '1',
            'image_id' => null,
            'map_id' => null,
            'lat' => '49.246292',
            'lng' => '-123.116226',
            'name' => 'Vancouver',
            'description' => 'Some lengthy description about this location'
        ]);

        DB::table('location_author')->insert([
            'location_id' => '1',
            'author_id' => '1'
        ]);


        // Location without a blog
        DB::table('locations')->insert([
            'country_id' => '1',
            'image_id' => null,
            'map_id' => null,
            'lat' => '‎48.407326',
            'lng' => '‎-123.329773  ',
            'name' => 'Victoria',
            'description' => 'Some lengthy description about this location'
        ]);

        DB::table('location_author')->insert([
            'location_id' => '2',
            'author_id' => '1'
        ]);

        /**
         * Trip blog setup
         */
        DB::table('blogs')->insert([
            'author_id' => '1',
            'status' => 'published',
            'title' => 'Test Trip blog',
            'excerpt' => 'Some excerpt comment',
            'content' => 'This is the main body of text for the blog'
        ]);

        DB::table('blog_relation')->insert([
            'blog_id' => '1',
            'relation_id' => '1',
            'type' => 'trips'
        ]);

        DB::table('trips')->insert([
            'image_id' => null,
            'map_id' => null,
            'name' => 'Around Vancouver',
            'start_date' => '2016-11-01',
            'end_date' => '2017-02-01',
            'description' => 'Some description about this big trip I did'
        ]);

        DB::table('trip_author')->insert([
            'trip_id' => '1',
            'author_id' => '1'
        ]);

        DB::table('trip_location')->insert([
            'trip_id' => '1',
            'location_id' => '1'
        ]);

        DB::table('trip_location')->insert([
            'trip_id' => '1',
            'location_id' => '2'
        ]);

    }
}
