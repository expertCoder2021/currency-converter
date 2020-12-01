<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('currencies')->insert([
                'attr_id' => $faker->numberBetween(1,100),
                'name' => $faker->lastName,
                'value' => random_int(11111,99999),
                'num_code' => rand(111,999),
                'char_code' => $faker->word,
                'nominal' => rand(00,99),
                'date' => '2020-12-02',
            ]);
        }
    }
}
