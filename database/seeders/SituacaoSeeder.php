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
            'descricao' => 'Em processo',
            'cor' => '#50a33a',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('situacaos')->insert([
            'descricao' => 'Cancelado',
            'cor' => '#252525',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('situacaos')->insert([
            'descricao' => 'Concluído',
            'cor' => '#357d00',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
