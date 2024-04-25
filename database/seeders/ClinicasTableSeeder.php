<?php

namespace Database\Seeders;
use App\Models\Clinica;
use Illuminate\Database\Seeder;

class ClinicasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clinica::create([
            'nome'=>'NTC Matriz',
            'cfc_id' => '1'
        ]);

        Clinica::create([
            'nome'=>'NTC Messejana',
            'cfc_id' => '2'
        ]);
    }
}