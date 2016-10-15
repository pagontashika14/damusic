<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Permission;

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
            'name' => 'Dương Tuấn Đạt',
            'email' => 'pagontashika14@gmail.com',
            'password' => bcrypt('dat123456'),
            'api_token' => bcrypt('pagontashika14@gmail.com')
        ]);

        DB::table('roles')->insert([
            'code' => bcrypt('mod'),
            'name' => 'mod',
            'display_name' => 'Moderator',
            'order' => 1,
        ]);

        DB::table('roles')->insert([
            'code' => bcrypt('admin'),
            'name' => 'admin',
            'display_name' => 'Admin',
            'order' => 2,
        ]);

        DB::table('roles')->insert([
            'code' => bcrypt('friend'),
            'name' => 'friend',
            'display_name' => 'Member Friendly',
            'order' => 3,
        ]);

        DB::table('roles')->insert([
            'code' => bcrypt('member'),
            'name' => 'member',
            'display_name' => 'Member',
            'order' => 4,
        ]);

        $user = User::where('email','pagontashika14@gmail.com')->first();
        $role = Role::where('name','mod')->first();
        $user->roles()->attach($role->id);
    }
}
