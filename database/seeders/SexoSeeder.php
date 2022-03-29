<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sexos')->insert([
            'descricao' => 'Homem',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sexos')->insert([
            'descricao' => 'Mulher',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sexos')->insert([
            'descricao' => 'Outro',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
