<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AtendimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('atendimentos')->insert([
            'situacao_id' => 1,


            'necessidade_id' => 1,
            'user_id' => 2,
           'nome'=> 'Rafael da Silva',


            'whats' => '46911151515',
            'email' => 'email@email.com',

            'datacadastro' => now(),
            'dataagendamento' => now(),
            'cidade_id' => 1,
            'online' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'retorno' => true
        ]);




    }
}
