<?php

use App\Role;
use App\Permission;
use App\User;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $edit = Permission::where('slug', 'edit')->first();
        $view = Permission::where('slug', 'view')->first();
        $manage= Permission::where('slug', 'manage')->first();
        $manager = Role::where('slug', 'manager')->first();
        $user = User::where('name', 'Dung')->first();
        // $user->permissions()->attach($view);
        $user->roles()->attach($manager);

    }
}
