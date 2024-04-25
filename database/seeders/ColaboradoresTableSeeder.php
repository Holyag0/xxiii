<?php

namespace Database\Seeders;
use App\Models\Colaborador;
use Illuminate\Database\Seeder;

class ColaboradoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /**DESENVOLVIMENTO**/
       Colaborador::create([
        'cfc_id'=>1,
        'nome'=>'André',
        'funcoes' => '1',
        'cpf'=>'000.000.000-00'
    ]);
    }
}
