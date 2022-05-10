<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ParametroAtendimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parametro_atendimentos')->insert([
            'id' => 1,
            'tempo' => '30',
            'onlyMyCity' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
