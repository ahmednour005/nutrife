<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    User::truncate();
    DB::table('role_user')->truncate();
    $adminRole = Role::where('name','Admin')->first();
    $userRole = Role::where('name','User')->first();
    $web_Developer_Role = Role::where('name','Web Developer')->first();
    $call_Center_Role = Role::where('name','Call Center')->first();
    $Call_center_leader_Role = Role::where('name','Call Center Leader')->first();

        $admin = User::create([
            'name'=>'Admin',
            'email' => 'admin@nutrife.com',
            'password' => Hash::make('nutrife123')
        ]);
        $user = User::create([
            'name'=>'User',
            'email' => 'user@nutrife.com',
            'password' => Hash::make('nutrife123')
        ]);
        $call_center = User::create([
            'name'=>'Call Center',
            'email' => 'callcenter@nutrife.com',
            'password' => Hash::make('nutrife123')
        ]);
        $Call_center_leader = User::create([
            'name'=>'Call Center Leader',
            'email' => 'callcenterl@nutrife.com',
            'password' => Hash::make('nutrife123')
        ]);
        $web_developer = User::create([
            'name'=>'Web Developer',
            'email' => 'webdeveloper@nutrife.com',
            'password' => Hash::make('nutrife123')
        ]);

        $admin->roles()->attach($adminRole);
        $web_developer->roles()->attach($web_Developer_Role);
        $user->roles()->attach($userRole);
        $call_center->roles()->attach($call_Center_Role);
        $Call_center_leader->roles()->attach($Call_center_leader_Role);
    }
}
