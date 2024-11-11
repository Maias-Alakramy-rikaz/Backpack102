<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'show-dashboard']);
        Permission::create(['name' => 'manage-users']);
        Permission::create(['name' => 'manage-roles']);
        Permission::create(['name' => 'manage-permissions']);
        Permission::create(['name' => 'manage-teachers']);
        Permission::create(['name' => 'manage-courses']);
        Permission::create(['name' => 'manage-students']);

        $adminRole = Role::create(['name' => 'Admin']);
        $principalRole = Role::create(['name' => 'Principal']);

        $adminRole->givePermissionTo(Permission::all());
        $principalRole->givePermissionTo(['manage-students','manage-teachers','manage-courses']);
    }
}