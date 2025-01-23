<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasPeliculasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias_peliculas')->insert([
            ['pelicula_id' => 1, 'categoria_id' => 1], 
            ['pelicula_id' => 2, 'categoria_id' => 1], 
            ['pelicula_id' => 3, 'categoria_id' => 4], 
            ['pelicula_id' => 4, 'categoria_id' => 3],
            ['pelicula_id' => 5, 'categoria_id' => 5] 
        ]);
    }
}
