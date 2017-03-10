<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' 		=> 'Ryan Stephens',
            'email'		=> 'diving.bc@gmail.com',
            'password' 	=> bcrypt('secret'),
        ]);
    }
}
