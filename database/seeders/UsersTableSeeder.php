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
            'picture' => 'profile_user/6UdmP9p2fSio8dhVJL48usSYvKL7uLOCHmoZrr9D.jpeg',
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
            'picture' => 'profile_user/H6M3e7ZBpcfRjBNWPjGOfEqcX0v2ckDQLXXmD964.jpeg',
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
            'picture' => 'profile_user/ZSyUEfbZOpL5cqfr87UO2heFtj6nVOs32I83xb6B.jpeg',
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
            'picture' => 'profile_user/b7uosQuX8oY8CJIFvPeYtJFinIoeW6xyFEOjeXSM.jpeg',
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
            'picture' => 'profile_user/JsndwKCE9byFoIbe1x9p9bHP6SlUWQZI9A5cGW2u.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#d47bfd'
        ]);
        DB::table('users')->insert([
            'id' => 6,
            'name' => 'Isadora DallAgnol',
            'email' => 'isadora@fkprevidencia.adv.br',
            'password' => Hash::make('isadora123'),
            'role_id' => 2,
            'picture' => 'profile_user/hPgkAa5m1KThapf0LdWPaekcWj2TxFSy8WV8YEpp.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#fd5eb0'
        ]);

    }
}
