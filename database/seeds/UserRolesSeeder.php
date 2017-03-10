<?php

use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        \HttpOz\Roles\Models\Role::create([
            'name' => 'System Admin',
            'slug' => 'sysadmin',
            'description' => 'Typically the senior developer of the entire system.', // optional
            'group' => 'default' // optional, set as 'default' by default
        ]);
        
        \HttpOz\Roles\Models\Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Custodians of the system. This is typically the person the site was built for.', // optional
            'group' => 'default' // optional, set as 'default' by default
        ]);

        \HttpOz\Roles\Models\Role::create([
            'name' => 'Moderator',
            'slug' => 'moderator',
        ]);

        DB::table('role_user')->insert([
            'user_id'   => '1',
            'role_id'   => '1',
        ]);
    }
}
