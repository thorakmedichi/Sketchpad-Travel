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
        DB::table('blog_relations')->insert([
            'blog_id' => '1',
            'blog_relation_id' => '1',
            'blog_relation_type' => 'App\Location'
        ]);

        DB::table('locations')->insert([
            'country_id' => 'CA',
            'image_id' => null,
            'map_id' => null,
            'lat' => '49.24629',
            'lng' => '-123.116',
            'name' => 'Vancouver',
            'description' => 'Some lengthy description about this location',
            'visit_date' => '2016-11-15'
        ]);

        DB::table('location_authors')->insert([
            'location_id' => '1',
            'author_id' => '1'
        ]);


        // Location without a blog
        DB::table('locations')->insert([
            'country_id' => 'CA',
            'image_id' => null,
            'map_id' => null,
            'lat' => '48.40732',
            'lng' => '-123.329',
            'name' => 'Victoria',
            'description' => 'Some lengthy description about this location',
            'visit_date' => '2016-12-15'
        ]);

        DB::table('location_authors')->insert([
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

        DB::table('blog_relations')->insert([
            'blog_id' => '2',
            'blog_relation_id' => '1',
            'blog_relation_type' => 'App\Trip'
        ]);

        DB::table('trips')->insert([
            'image_id' => null,
            'map_id' => null,
            'name' => 'Around Vancouver',
            'start_date' => '2016-11-01',
            'end_date' => '2017-02-01',
            'description' => 'Some description about this big trip I did'
        ]);

        DB::table('trip_authors')->insert([
            'trip_id' => '1',
            'author_id' => '1'
        ]);

        DB::table('trip_locations')->insert([
            'trip_id' => '1',
            'location_id' => '1'
        ]);

        DB::table('trip_locations')->insert([
            'trip_id' => '1',
            'location_id' => '2'
        ]);

    }
}
