<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BoxofficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                DB::table('boxoffices')->insert([
                    'film_id' => 1,  
                    'amount' => 500000000.00,
                    'currency' => 'USD',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        
                DB::table('boxoffices')->insert([
                    'film_id' => 2,  
                    'amount' => 750000000.00,
                    'currency' => 'USD',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    }
}
