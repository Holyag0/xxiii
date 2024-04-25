<?php

namespace Database\Seeders;
use App\Models\Servicos;
use Illuminate\Database\Seeder;

class ServicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicos::create([
            'cfc_id'=> 1,
            'nome'=>'Exame Psicológico',
            'valor'=>'160.00',
        ]);
        Servicos::create([
            'cfc_id'=> 1,
            'nome'=>'Exame Médico',
            'valor'=>'98.00',
        ]);
    }
}