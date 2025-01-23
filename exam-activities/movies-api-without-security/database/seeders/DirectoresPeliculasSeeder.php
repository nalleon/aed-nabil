<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectoresPeliculasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('directores_peliculas')->insert([
            ['pelicula_id' => 1, 'director_id' => 1], 
            ['pelicula_id' => 2, 'director_id' => 2],
            ['pelicula_id' => 3, 'director_id' => 1], 
            ['pelicula_id' => 4, 'director_id' => 1], 
            ['pelicula_id' => 5, 'director_id' => 3]
        ]);
    }
}
