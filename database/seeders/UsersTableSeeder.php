<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**DESENVOLVIMENTO**/
        $user = User::create([
            'name'=>'Hiago Santos',
            'email'=>'mikjdmik@gmail.com',
            'password'=>bcrypt('1234')
        ]);

        $permissions = Permission::pluck('id','id')->all();

        $role = Role::where('id',1)->first();

        $role->syncPermissions($permissions);

        $user->assignRole([1]);
    }
}
