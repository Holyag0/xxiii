<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CfcTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ClinicasTableSeeder::class);
        $this->call(ColaboradoresTableSeeder::class);
        $this->call(ServicoTableSeeder::class);
        $this->call(AlunoTableSeeder::class);
        $this->call(CategoriaTableSeeder::class);
        $this->call(UserCfcTableSeeder::class);
    }
}
