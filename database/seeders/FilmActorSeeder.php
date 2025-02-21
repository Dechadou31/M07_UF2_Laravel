<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $films = DB::table('films')->pluck('id')->toArray();
                $actors = DB::table('actors')->pluck('id')->toArray();
        
                foreach ($films as $film) {
                    $randomActors = array_rand($actors, rand(1, 3));
        
                    foreach ((array) $randomActors as $actor) {
                        DB::table('films_actors')->insert([
                            'film_id' => $film,
                            'actor_id' => $actors[$actor],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                 }
            }
    }
}
