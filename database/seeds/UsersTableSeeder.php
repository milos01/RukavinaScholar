<?php

use Illuminate\Database\Seeder;
// use Carbon/Carbon;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Role table seeds
        DB::table('roles')->insert([
            'name' => 'regular',
            'created_at' => '2008-10-29 14:56:59',
            'updated_at' => '2008-10-29 14:56:59',
        ]);

        DB::table('roles')->insert([
            'name' => 'moderator',
            'created_at' => '2008-10-29 14:56:59',
            'updated_at' => '2008-10-29 14:56:59',
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'created_at' => '2008-10-29 14:56:59',
            'updated_at' => '2008-10-29 14:56:59',
        ]);

        // User table seeds
        DB::table('users')->insert([
            'name' => 'Jon',
            'lastName' => 'Olson',
            'role_id' => '3',
            'picture' => 'a2.jpg',
            'email' => 'jon@gmail.com',
            'password' => Hash::make('pass'),
            'created_at' => '2008-10-29 14:56:59',
        ]);

        DB::table('users')->insert([
            'name' => 'Moderator',
            'lastName' => 'User',
            'role_id' => '2',
            'picture' => 'a4.jpg',
            'email' => 'moderator@gmail.com',
            'password' => Hash::make('pass'),
            'created_at' => '2008-10-29 14:56:59',
        ]);

        DB::table('users')->insert([
            'name' => 'Moderator2',
            'lastName' => 'User',
            'role_id' => '2',
            'picture' => 'a5.jpg',
            'email' => 'moderator2@gmail.com',
            'password' => Hash::make('pass'),
            'created_at' => '2008-10-29 14:56:59',
        ]);

        DB::table('users')->insert([
            'name' => 'Regular',
            'lastName' => 'User',
            'role_id' => '1',
            'picture' => 'a1.jpg',
            'email' => 'regular@gmail.com',
            'password' => Hash::make('pass'),
            'created_at' => '2008-10-29 14:56:59',
        ]);

        DB::table('users')->insert([
            'name' => 'Regular2',
            'lastName' => 'User',
            'role_id' => '1role_id',
            'picture' => 'a3.jpg',
            'email' => 'regular2@gmail.com',
            'password' => Hash::make('pass'),
            'created_at' => '2008-10-29 14:56:59',
        ]);
    }
}
