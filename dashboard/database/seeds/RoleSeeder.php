<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $manager = new Role;
        $manager->name = 'manager';
        $manager->slug = 'manager';
        $manager->save();
        
        $editor = new Role;
        $editor->name = 'editor';
        $editor->slug = 'editor';
        $editor->save();

        $deleter = new Role;
        $deleter->name = 'deleter';
        $deleter->slug = 'deleter';
        $deleter->save();
    }
}
