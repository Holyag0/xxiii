<?php

namespace Database\Seeders;
use App\Models\UserCfc;
use Illuminate\Database\Seeder;

class UserCfcTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserCfc::create([
            'id' => 1,
            'cfc_id'=> 1,
            'user_id'=>1, 
            'created_at' => '1998-06-23',
            'updated_at' => '1998-06-23'
        ]);
       
    }
}