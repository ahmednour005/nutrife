<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Role::create(['name'=>'Admin']);
        Role::create(['name'=>'Web Developer']);
        Role::create(['name'=>'User']);
        Role::create(['name'=>'Call Center']);
        Role::create(['name'=>'Call Center Leader']);
    }
}
