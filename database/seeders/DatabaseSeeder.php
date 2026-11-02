<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $lecturerRole = Role::firstOrCreate(['name' => 'lecturer']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);

        // Create Admin User & Assign Role
        $admin = User::firstOrCreate(
            ['email' => 'admin@mubs.ac.ug'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('AdminPassword123!'),
            ]
        );
        $admin->assignRole($adminRole);

        // Create Lecturer User & Assign Role
        $lecturer = User::firstOrCreate(
            ['email' => 'lecturer@mubs.ac.ug'],
            [
                'name' => 'Course Lecturer',
                'password' => Hash::make('LecturerPassword123!'),
            ]
        );
        $lecturer->assignRole($lecturerRole);

        // Create Student User & Assign Role
        $student = User::firstOrCreate(
            ['email' => 'arnold@mubs.ac.ug'],
            [
                'name' => 'Kiggundu Arnold Constant',
                'password' => Hash::make('Password123!'),
            ]
        );
        $student->assignRole($studentRole);
    }
}