<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'manage-students',
            'manage-courses',
            'manage-registrations',
            'view-assigned-courses',
            'view-enrolled-students',
            'view-available-courses',
            'view-own-registrations',
            'register-courses',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Administrator Role
        $adminRole = Role::firstOrCreate(['name' => 'Administrator']);
        $adminRole->syncPermissions(['manage-students', 'manage-courses', 'manage-registrations']);

        // Lecturer Role
        $lecturerRole = Role::firstOrCreate(['name' => 'Lecturer']);
        $lecturerRole->syncPermissions(['view-assigned-courses', 'view-enrolled-students']);

        // Student Role
        $studentRole = Role::firstOrCreate(['name' => 'Student']);
        $studentRole->syncPermissions(['view-available-courses', 'view-own-registrations', 'register-courses']);
    }
}