<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([

            'user_id' => 2,
            'atendimento_id' => 1,
            'title' => 'Pereira Prestes',
            'description' => 'Auxílio Acidente',
            'allDay' => true,
            'start' => now() ,
            'end' => now(),
             'created_at' => now(),
            'updated_at' => now()

        ]);
    }
}
