<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Augusto Silverio Soares',
            'email' => 'augusto@augusto',
            'password' => Hash::make('augusto123'),
            'role_id' => 1,
            'picture' => '../argon/img/theme/team-3.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#b0ffff'
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Lucas Kuchenny',
            'email' => 'lucas@fkprevidencia.adv.br',
            'password' => Hash::make('lucas123'),
            'role_id' => 2,
            'picture' => '../argon/img/theme/team-4.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#6b6b6b'
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Gilvan Pigoso',
            'email' => 'gilvan@fkprevidencia.adv.br',
            'password' => Hash::make('gilvan123'),
            'role_id' => 2,
            'picture' => '../argon/img/theme/team-5.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#b1ffb7'
        ]);
        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Ana Carla',
            'email' => 'anacarla@fkprevidencia.adv.br',
            'password' => Hash::make('ana123'),
            'role_id' => 2,
            'picture' => '../argon/img/theme/team-5.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#7b81fd'
        ]);
        DB::table('users')->insert([
            'id' => 5,
            'name' => 'Géssica Veloso',
            'email' => 'gessica@fkprevidencia.adv.br',
            'password' => Hash::make('gessica123'),
            'role_id' => 2,
            'picture' => '../argon/img/theme/team-5.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#d47bfd'
        ]);
        DB::table('users')->insert([
            'id' => 6,
            'name' => 'Isadora DallAgnol',
            'email' => 'isadora@fkprevidencia.adv.br',
            'password' => Hash::make('gessica123'),
            'role_id' => 2,
            'picture' => '../argon/img/theme/team-5.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#fd5eb0'
        ]);

    }
}
