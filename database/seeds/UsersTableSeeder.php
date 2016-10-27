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
            'name' => 'Regular',
            'lastName' => 'User',
            'role' => 'regular',
            'picture' => 'a1.jpg',
            'email' => 'regular@gmail.com',
            'password' => Hash::make('pass'),
            'created_at' => '2008-10-29 14:56:59',
        ]);
    }
}
