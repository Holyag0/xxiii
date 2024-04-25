<?php

namespace Database\Seeders;
use App\Models\Aluno;
use Illuminate\Database\Seeder;

class AlunoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aluno::create([
            'nome'=>'Primeiro Aluno',
            'cpf'=>'000.000.000-00',
            'cfc_id'=>'2',
            'clinica_id' =>'1'
              
        ]);
        Aluno::create([
            'nome'=>'Segundo Aluno',
            'cpf'=>'111.111.111-11',
            'cfc_id'=>'2',
            'clinica_id' =>'1'
        ]);
        Aluno::create([
            'nome'=>'Terceiro Aluno',
            'cpf'=>'222.222.222-22',
            'cfc_id'=>'3',
            'clinica_id' =>'1'
        ]);
        Aluno::create([
            'nome'=>'Quarto Aluno',
            'cpf'=>'333.333.333-33',
            'cfc_id'=>'1',
            'clinica_id' =>'1'
        ]);
    }
}
