<?php

namespace Database\Seeders;
use App\Models\Cfc;
use Illuminate\Database\Seeder;

class CfcTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cfc::create([
            'cnpj'=>'00.000.000/0000-00',
            'nome'=>'CFC Aquino',
        ]);
        Cfc::create([
            'cnpj'=>'11.111.111/1111-11',
            'nome'=>'CFC João XXIII',
        ]);
        Cfc::create([
            'cnpj'=>'22222222222222',
            'nome'=>'CFC Aquino Bom Jardim',
        ]);
        Cfc::create([
            'cnpj'=>'33333333333333',
            'nome'=>'CFC Ideal Filial',
        ]);
        Cfc::create([
            'cnpj'=>'00.762.467.0002-50',
            'nome'=>'CFC Aquino Filial',
        ]);
    }
}
