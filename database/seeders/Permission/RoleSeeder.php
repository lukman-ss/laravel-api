<?php

namespace Database\Seeders\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role = Role::create(['name' => 'guest']);
        $role = Role::create(['name' => 'user']);
        $role = Role::create(['name' => 'student']);
        $role = Role::create(['name' => 'teacher']);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'super_admin']);
    }
}
