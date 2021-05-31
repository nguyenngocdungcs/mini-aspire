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
        \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => \App\User::ROLE_ADMIN,
            'password' => bcrypt('123123123'),
        ]);

        \App\User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'role_id' => \App\User::ROLE_USER,
            'password' => bcrypt('123123123'),
        ]);

    }
}
