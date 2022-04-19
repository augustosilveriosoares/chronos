<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SituacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('situacaos')->insert([
            'descricao' => 'Pendente',
            'cor' => '#fc1535',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('situacaos')->insert([
            'descricao' => 'Agendado',
            'cor' => '#5595ff',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('situacaos')->insert([
            'descricao' => 'Análise',
            'cor' => '#999999',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('situacaos')->insert([
        'descricao' => 'Processo',
        'cor' => '#999999',
        'created_at' => now(),
        'updated_at' => now()
        ]);

        DB::table('situacaos')->insert([
            'descricao' => 'Direito Futuro',
            'cor' => '#d2f7a2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('situacaos')->insert([
            'descricao' => 'Infrutifero',
            'cor' => '#ffd59a',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('situacaos')->insert([
            'descricao' => 'Cancelado',
            'cor' => '#e83218',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
