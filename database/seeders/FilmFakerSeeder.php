<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Genera 10 películas
        foreach (range(1, 10) as $index) {
            DB::table('films')->insert([
                'name' => $faker->word(),
                'year' => $faker->year(),
                'genre' => $faker->word(),
                'country' => $faker->country(),
                'duration' => $faker->numberBetween(90, 180),
                'img_url' => $faker->imageUrl(640, 480, 'film'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
