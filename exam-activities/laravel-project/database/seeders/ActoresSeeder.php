<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('actores')->insert([
            ['nombre' => 'Leonardo', 'apellidos' => 'DiCaprio'],
            ['nombre' => 'Keanu', 'apellidos' => 'Reeves'],
            ['nombre' => 'Matthew', 'apellidos' => 'McConaughey'],
            ['nombre' => 'Christian', 'apellidos' => 'Bale'],
            ['nombre' => 'Uma', 'apellidos' => 'Thurman']
        ]);
    }
}
