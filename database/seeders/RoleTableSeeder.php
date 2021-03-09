<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name="guest";
        $role->save();
        $role = new Role();
        $role->name="user";
        $role->save();
        $role = new Role();
        $role->name="loader";
        $role->save();
        $role = new Role();
        $role->name="admin";
        $role->save();
    }
}
