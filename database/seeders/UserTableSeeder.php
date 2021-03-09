<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'user')->first();
        $role_guest = Role::where('name', 'guest')->first();
        $role_loader = Role::where('name', 'loader')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = new User();
        $user->name="raquel";
        $user->email="raquel@gmail.com";
        $user->password=Hash::make('raquel123');
        $user->role_id= $role_admin->id;
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name="joan";
        $user->email="joan@gmail.com";
        $user->password=Hash::make('joan123');
        $user->role_id= $role_guest->id;
        $user->save();
        $user->roles()->attach($role_guest);

        $user = new User();
        $user->name="sandra";
        $user->email="sandra@gmail.com";
        $user->password=Hash::make('sandra123');
        $user->role_id= $role_user->id;
        $user->save();
        $user->roles()->attach($role_user);


        $user = new User();
        $user->name="pili";
        $user->email="pili@gmail.com";
        $user->password=Hash::make('pili123');
        $user->role_id= $role_loader->id;
        $user->save();
        $user->roles()->attach($role_loader);
    }
}
