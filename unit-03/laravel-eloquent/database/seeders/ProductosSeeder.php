<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('productos')->insert([
            'name' => $faker->word, 
            'price' => $faker->randomFloat(2, 1, 20), 
            'quantity' => $faker->numberBetween(1, 100),
        ]);
        
    }
}
