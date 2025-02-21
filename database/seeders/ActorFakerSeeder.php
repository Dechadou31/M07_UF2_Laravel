<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        
        foreach (range(1, 10) as $index) {
            DB::table('actors')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'birthdate' => $faker->date('Y-m-d', '2000-12-31'), 
                'country' => $faker->country(),
                'img_url' => $faker->imageUrl(640, 480, 'people'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
