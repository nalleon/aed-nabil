<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeliculasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('peliculas')->insert([
            ['titulo' => 'Inception', 'year' => 2010, 'descripcion' => 'A mind-bending thriller about dreams within dreams.', 'trailer' => 'https://www.youtube.com/watch?v=YoHD9XEInc0', 'caratula' => 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fflxt.tmsimg.com%2Fassets%2Fp7825626_p_v8_af.jpg&f=1&nofb=1&ipt=1fb7e66511f694363607b3af5b2bf3d2a962704a75fc6a8f19cfbcfe76c35451&ipo=images'],
            ['titulo' => 'The Matrix', 'year' => 1999, 'descripcion' => 'A hacker discovers the true nature of reality.', 'trailer' => 'https://www.youtube.com/watch?v=Pl_H2Lmjn6k', 'caratula' => 'https://www.themoviedb.org/t/p/original/dXNAPwY7VrqMAo51EKhhCJfaGb5.jpg'],
            ['titulo' => 'Interstellar', 'year' => 2014, 'descripcion' => 'A space exploration journey to save humanity.', 'trailer' => 'https://www.youtube.com/watch?v=LYS2O1nl9iM', 'caratula' => 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmir-s3-cdn-cf.behance.net%2Fproject_modules%2Fmax_1200%2F8d8f28105415493.619ded067937d.jpg&f=1&nofb=1&ipt=215768c0d2c3d9c9149ece73bb038018d2a8d0a871c4b32e6405b6511be3ff58&ipo=images'],
            ['titulo' => 'The Dark Knight', 'year' => 2008, 'descripcion' => 'A vigilante fights crime in Gotham City.', 'trailer' => 'https://www.youtube.com/watch?v=EXeTwQWrcwY', 'caratula' => 'https://www.themoviedb.org/t/p/original/2Ka2nOtSlwuFlsHtrtfHKMIjldC.jpg'],
            ['titulo' => 'Pulp Fiction', 'year' => 1994, 'descripcion' => 'A series of interconnected stories in Los Angeles.', 'trailer' => 'https://www.youtube.com/watch?v=tGpTpVyI_OQ', 'caratula' => 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.themoviedb.org%2Ft%2Fp%2Foriginal%2FpbWgQPC6l9pkpEpi3WNRSfWYNP6.jpg&f=1&nofb=1&ipt=b8192334a6a3170a85bf8c14746e7ea1180c03bef53e06f304a9b81c72311acc&ipo=images']
        ]);
    }
}
