<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('directores')->insert([
            ['nombre' => 'Christopher', 'apellidos' => 'Nolan'],
            ['nombre' => 'Lana', 'apellidos' => 'Wachowski'],
            ['nombre' => 'Quentin', 'apellidos' => 'Tarantino'],
            ['nombre' => 'Steven', 'apellidos' => 'Spielberg'],
            ['nombre' => 'Ridley', 'apellidos' => 'Scott']
        ]);
    }
}
