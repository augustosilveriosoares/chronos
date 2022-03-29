<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AtuacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('atuacaos')->insert([
            'descricao' => 'Saúde',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('atuacaos')->insert([
            'descricao' => 'Educação',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('atuacaos')->insert([
            'descricao' => 'Segurança',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('atuacaos')->insert([
            'descricao' => 'Indústria',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('atuacaos')->insert([
            'descricao' => 'Agricultura',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('atuacaos')->insert([
            'descricao' => 'Comércio',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('atuacaos')->insert([
            'descricao' => 'Outro',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
