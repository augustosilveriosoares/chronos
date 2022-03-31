<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TipoAtendimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_atendimentos')->insert([
            'id' => 1,
            'descricao' => 'Inicial',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tipo_atendimentos')->insert([
            'id' => 2,
            'descricao' => 'Retorno',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tipo_atendimentos')->insert([
            'id' => 3,
            'descricao' => 'Orientação',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
