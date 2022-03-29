<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class NecessidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('necessidades')->insert([
            'descricao' => 'Aposentadoria',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('necessidades')->insert([
            'descricao' => 'Pensão',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('necessidades')->insert([
            'descricao' => 'Auxílio',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('necessidades')->insert([
            'descricao' => 'Revisão',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('necessidades')->insert([
            'descricao' => 'Recurso',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('necessidades')->insert([
            'descricao' => 'Planejamento Previdenciário',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
