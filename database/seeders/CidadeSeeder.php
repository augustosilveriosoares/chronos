<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cidades')->insert([
            'id' => 1,
            'nome' => 'Curitiba',

        ]);
        DB::table('cidades')->insert([
            'id' => 2,
            'nome' => 'Pato Branco',

        ]);
        DB::table('cidades')->insert([
            'id' => 3,
            'nome' => 'Clevelândia',

        ]);
        DB::table('cidades')->insert([
            'id' => 4,
            'nome' => 'Palmas',

        ]);
        DB::table('cidades')->insert([
            'id' => 5,
            'nome' => 'Mangueirinha',

        ]);
        DB::table('cidades')->insert([
            'id' => 6,
            'nome' => 'Coronel Vivida',

        ]);

    }
}
