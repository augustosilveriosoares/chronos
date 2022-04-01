<?php
namespace Database\Seeders;
use App\Cidade;
use App\ParametroAtendimento;
use App\TipoAtendimento;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');


        $this->call([RolesTableSeeder::class, UsersTableSeeder::class]);
        $this->call([TagsTableSeeder::class, CategoriesTableSeeder::class, ItemsTableSeeder::class]);
        $this->call( NecessidadeSeeder::Class);
        $this->call(SituacaoSeeder::class);
        $this->call(SexoSeeder::class);
        $this->call(NecessidadeSeeder::class);
        $this->call(AtuacaoSeeder::class);
        $this->call(AtendimentoSeeder::class);
        $this->call(EventsSeeder::class);
        $this->call(CidadeSeeder::class);
        $this->call(TipoAtendimentoSeeder::class);
        $this->call(ParametroAtendimentoSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
