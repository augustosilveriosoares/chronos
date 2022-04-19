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

            'name' => 'Augusto Silverio Soares',
            'email' => 'augusto@fkprevidencia.adv.br',
            'password' => Hash::make('augusto1120301'),
            'role_id' => 1,
            'picture' => 'profile_user/tgcoppt8TQLvAXr0LPeCWQVdRGLwqEy5Uni78EdS.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#b0ffff'
        ]);

        DB::table('users')->insert([

            'name' => 'Fabrício Kleinibing',
            'email' => 'fabricio@fkprevidencia.adv.br',
            'picture' => 'profile_user/qNaeF7VsXTNWK0HUX3z35Z0J5H8Zdu28DjxiKTBe.jpeg',
            'password' => Hash::make('fkprev4026'),
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#6e6e6e'
        ]);
        DB::table('users')->insert([

            'name' => 'Gilvan Pigoso',
            'email' => 'gilvan@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'role_id' => 2,
            'picture' => 'profile_user/ZSyUEfbZOpL5cqfr87UO2heFtj6nVOs32I83xb6B.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#b1ffb7'
        ]);

        DB::table('users')->insert([

            'name' => 'Fernando Librelato',
            'email' => 'fernando@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/0ojddtqqzamA8Afo63UJytivWVjxXa3cFnJXdlcc.jpeg',
            'role_id' => 2,
                        'created_at' => now(),
            'updated_at' => now(),
            'color' => '#b1ffb7'
        ]);
        DB::table('users')->insert([

            'name' => 'Ana Carla',
            'email' => 'anacarla@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'role_id' => 2,
            'picture' => 'profile_user/b7uosQuX8oY8CJIFvPeYtJFinIoeW6xyFEOjeXSM.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#7b81fd'
        ]);
        DB::table('users')->insert([

            'name' => 'Isadora DallAgnol',
            'email' => 'isadora@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'role_id' => 2,
            'picture' => 'profile_user/hPgkAa5m1KThapf0LdWPaekcWj2TxFSy8WV8YEpp.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#fd7eb0'
        ]);

        DB::table('users')->insert([

            'name' => 'Géssica Veloso',
            'email' => 'gessica@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'role_id' => 2,
            'picture' => 'profile_user/JsndwKCE9byFoIbe1x9p9bHP6SlUWQZI9A5cGW2u.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#d47bfd'
        ]);

        DB::table('users')->insert([
            'name' => 'Lucas Kuchenny',
            'email' => 'lucas@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'role_id' => 2,
            'picture' => 'profile_user/H6M3e7ZBpcfRjBNWPjGOfEqcX0v2ckDQLXXmD964.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#6b6b6b'
        ]);

        DB::table('users')->insert([

            'name' => 'Juliana Di Domenico',
            'email' => 'juliana@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'role_id' => 2,
            'picture' => 'profile_user/H6M3e7ZBpcfRjBNWPjGOfEqcX0v2ckDQLXXmD964.jpeg',

            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#fd5eb0'
        ]);

        DB::table('users')->insert([

            'name' => 'Dione F. Antoniazzi',
            'email' => 'dione@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/PwuXRFEbqTYu6jIyo3unmZ2zP9YkQ1bLJkBu0Vz4.jpeg',
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#fd5eb0'
        ]);

        DB::table('users')->insert([

            'name' => 'Alexandre M. Santos',
            'email' => 'alexandre@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/wyBd9QvN5eCSQZlcM0AFhE6frxHlAKTeUienangr.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#c49141'
        ]);

        DB::table('users')->insert([

            'name' => 'Marisa Antonelo',
            'email' => 'marisa@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/zNYyv92siNPuHu2LeBFFJpInGpCdTyzLc6Qad1Ks.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#c47841'
        ]);

        DB::table('users')->insert([

            'name' => 'Kerly Daltoé',
            'email' => 'kerly@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/oItQFsUkcJQleuMkVXKp6XNWKVJ06bQ1zUmTVQ0P.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#c45c41'
        ]);

        DB::table('users')->insert([

            'name' => 'Carolina de Vasconcellos',
            'email' => 'carolina@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/dsuko4cLVVRtiVzHFsW0sZ8NHMNmlVWDgXTSB60h.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#ba91f2'
        ]);

        DB::table('users')->insert([

            'name' => 'Leandra Barbosa',
            'email' => 'leandra@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/lqO4ERHegxwC9tq6lw6YP8pQqbCeRWjbj8Talq9q.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#f291e3'
        ]);
        DB::table('users')->insert([
            'name' => 'Emanuele Ribeiro',
            'email' => 'emanuele@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/2j2UAw3UPvR5lDigBZQQJsHGH8L4TmbnVCvNLCxT.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#956bb9'
        ]);

        DB::table('users')->insert([
            'name' => 'Gustavo Pagnoncelli',
            'email' => 'gustavo@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/H6M3e7ZBpcfRjBNWPjGOfEqcX0v2ckDQLXXmD964.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#956bb9'
        ]);
        DB::table('users')->insert([
            'name' => 'Laysa Bortolotti',
            'email' => 'laysa@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/H6M3e7ZBpcfRjBNWPjGOfEqcX0v2ckDQLXXmD964.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#956bb9'
        ]);

        DB::table('users')->insert([
            'name' => 'Eduarda de Ávila',
            'email' => 'eduarda@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/pm3pggVuEUsiya6u9IUDmpKY7TILWWnlYABINhRb.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#956bb9'
        ]);
        DB::table('users')->insert([
            'name' => 'Josias Silveira',
            'email' => 'josias@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/CVKk0vKA1kXFNpbp9WFkUFkVrKg1rKNWHc7259oy.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#956bb9'
        ]);
        DB::table('users')->insert([
            'name' => 'Arthur Cantu',
            'email' => 'arthur@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/1FhCT4tByRP2sX95XS9BnJgDWB19Vphea6B1byna.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#956bb9'
        ]);

        DB::table('users')->insert([
            'name' => 'Rodrigo Jacobsen',
            'email' => 'rodrigo@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/zayL86CgPeF4K15UdC9ksuZ0LUUM5cKFfU0OBbXk.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#956bb9'
        ]);
        DB::table('users')->insert([
            'name' => 'Adyr Netto',
            'email' => 'adyr@fkprevidencia.adv.br',
            'password' => Hash::make('fkprev4026'),
            'picture' => 'profile_user/CyLZsTDzaT9wPyO7zR96105uL5aTGkJ8405lhY2u.jpeg',
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'color' => '#956bb9'
        ]);

    }
}
