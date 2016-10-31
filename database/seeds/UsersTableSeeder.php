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
         DB::table('users')->insert([
            'name' => 'Jon',
            'lastName' => 'Olson',
            'role' => 'admin',
            'picture' => 'a2.jpg',
            'email' => 'jon@gmail.com',
            'password' => Hash::make('pass'),
            'created_at' => '2008-10-29 14:56:59',
        ]);

        DB::table('users')->insert([
            'name' => 'Moderator',
            'lastName' => 'User',
            'role' => 'moderator',
            'picture' => 'a4.jpg',
            'email' => 'moderator@gmail.com',
            'password' => Hash::make('pass'),
            'created_at' => '2008-10-29 14:56:59',
        ]);

        DB::table('users')->insert([
            'name' => 'Moderator2',
            'lastName' => 'User',
            'role' => 'moderator',
            'picture' => 'a5.jpg',
            'email' => 'moderator2@gmail.com',
            'password' => Hash::make('pass'),
            'created_at' => '2008-10-29 14:56:59',
        ]);

        DB::table('users')->insert([
            'name' => 'Regular',
            'lastName' => 'User',
            'role' => 'regular',
            'picture' => 'a1.jpg',
            'email' => 'regular@gmail.com',
            'password' => Hash::make('pass'),
            'created_at' => '2008-10-29 14:56:59',
        ]);

        DB::table('users')->insert([
            'name' => 'Regular2',
            'lastName' => 'User',
            'role' => 'regular',
            'picture' => 'a3.jpg',
            'email' => 'regular2@gmail.com',
            'password' => Hash::make('pass'),
            'created_at' => '2008-10-29 14:56:59',
        ]);
    }
}
