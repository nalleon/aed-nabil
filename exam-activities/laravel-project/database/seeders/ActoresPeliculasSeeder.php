<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActoresPeliculasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('actores_peliculas')->insert([
            ['pelicula_id' => 1, 'actor_id' => 1], 
            ['pelicula_id' => 2, 'actor_id' => 2],
            ['pelicula_id' => 3, 'actor_id' => 3], 
            ['pelicula_id' => 4, 'actor_id' => 4], 
            ['pelicula_id' => 5, 'actor_id' => 5] 
        ]);
    }
}
