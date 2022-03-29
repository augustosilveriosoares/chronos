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
            'sexo_id' => 1,
            'atuacao_id' => 1,
            'necessidade_id' => 1,
            'user_id' => 2,
           'nome'=> 'Rafael da Silva',
            'idade' => '50',
            'anoscontribuicao' => '30',
            'whats' => '46911151515',
            'email' => 'email@email.com',
            'mensagem' => 'Ajuda para aposentadoria',
            'datacadastro' => now(),
            'dataagendamento' => now(),
            'cidade_id' => 1,
            'online' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'retorno' => true
        ]);
        DB::table('atendimentos')->insert([
            'situacao_id' => 1,
            'sexo_id' => 1,
            'atuacao_id' => 1,
            'necessidade_id' => 1,
            'user_id' => 3,
            'cidade_id' => null,
            'online' => true,
            'retorno' => true,

            'nome'=> 'Vandercleison da Silva',
            'idade' => '50',
            'anoscontribuicao' => '30',

            'whats' => '46911151515',
            'email' => 'email@email.com',
            'mensagem' => 'Ajuda para aposentadoria',
            'datacadastro' => now(),
            'dataagendamento' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('atendimentos')->insert([
            'situacao_id' => 1,
            'sexo_id' => 1,
            'atuacao_id' => 1,
            'necessidade_id' => 1,
            'user_id' => 4,
            'cidade_id' => 3,
            'online' => true,
            'retorno' => true,
            'nome'=> 'Carlos da Silva',
            'idade' => '50',
            'anoscontribuicao' => '30',
            'whats' => '46911151515',
            'email' => 'email@email.com',
            'mensagem' => 'Ajuda para aposentadoria',
            'datacadastro' => now(),
            'dataagendamento' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);



    }
}
