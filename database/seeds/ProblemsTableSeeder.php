<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ProblemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
        foreach (range(1, 5) as $index)

        {   
            DB::table('problems')->insert([
                'subject'      => $faker->word,
                'person_from'   => 4,
                'main_slovler'   => 1,
                'problem_type'       => 'Programming',
                'problem_description'       => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'took'       => 0,
                'waiting'       => 1,
                'created_at' => '2008-10-29 14:56:59',
                'updated_at' => '2008-10-29 14:56:59',
            ]);
        }

        foreach (range(1, 5) as $index)

        {   
            DB::table('problems')->insert([
                'subject'      => $faker->word,
                'person_from'   => 5,
                'main_slovler'   => 1,
                'problem_type'       => 'Math',
                'problem_description'       => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'took'       => 0,
                'waiting'       => 1,
                'created_at' => '2008-10-29 14:56:59',
                'updated_at' => '2008-10-29 14:56:59',
            ]);
        }
    }
}
