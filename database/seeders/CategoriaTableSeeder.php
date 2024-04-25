<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'cfc_id'=> 1,
            'name'=>'Exames Médicos',
        ]);
        Categoria::create([
            'cfc_id'=> 2,
            'name'=>'Exames Médicos',
        ]);
    }
}