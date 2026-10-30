<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleAndPermissionSeeder::class);

        // 1. Seed Administrator
        $admin = User::firstOrCreate(
            ['email' => 'admin@mubs.ac.ug'],
            ['name' => 'System Administrator', 'password' => Hash::make('Password123!')]
        );
        $admin->assignRole('Administrator');

        // 2. Seed Lecturer
        $lecturer = User::firstOrCreate(
            ['email' => 'lecturer@mubs.ac.ug'],
            ['name' => 'Dr. Paul Mukasa', 'password' => Hash::make('Password123!')]
        );
        $lecturer->assignRole('Lecturer');

        // 3. Seed 4 Courses
        $coursesData = [
            ['course_code' => 'BUC3131', 'title' => 'Advanced Web Application Development', 'credits' => 4],
            ['course_code' => 'BUC3132', 'title' => 'Database Administration', 'credits' => 3],
            ['course_code' => 'BUC3133', 'title' => 'Systems Analysis & Design', 'credits' => 3],
            ['course_code' => 'BUC3134', 'title' => 'E-Commerce Applications', 'credits' => 3],
        ];

        $createdCourses = [];
        foreach ($coursesData as $c) {
            $createdCourses[] = Course::firstOrCreate(
                ['course_code' => $c['course_code']],
                [
                    'title' => $c['title'],
                    'credits' => $c['credits'],
                    'description' => $c['title'] . ' course syllabus.',
                    'lecturer_id' => $lecturer->id,
                ]
            );
        }

        // 4. Seed 5 Students
        $studentsData = [
            ['name' => 'Kiggundu Arnold', 'email' => 'arnold@mubs.ac.ug', 'reg' => '24/U/1001/EVE', 'std' => '2400701001'],
            ['name' => 'Nakitto Sarah', 'email' => 'sarah@mubs.ac.ug', 'reg' => '24/U/1002/DAY', 'std' => '2400701002'],
            ['name' => 'Okello David', 'email' => 'david@mubs.ac.ug', 'reg' => '24/U/1003/EVE', 'std' => '2400701003'],
            ['name' => 'Achieng Florence', 'email' => 'florence@mubs.ac.ug', 'reg' => '24/U/1004/DAY', 'std' => '2400701004'],
            ['name' => 'Muwonge Ivan', 'email' => 'ivan@mubs.ac.ug', 'reg' => '24/U/1005/EVE', 'std' => '2400701005'],
        ];

        $createdStudents = [];
        foreach ($studentsData as $sData) {
            $user = User::firstOrCreate(
                ['email' => $sData['email']],
                ['name' => $sData['name'], 'password' => Hash::make('Password123!')]
            );
            $user->assignRole('Student');

            $student = Student::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'registration_number' => $sData['reg'],
                    'student_number' => $sData['std'],
                    'program' => 'Bachelor of Business Computing',
                    'year_of_study' => 3,
                ]
            );
            $createdStudents[] = $student;
        }

        // 5. Seed Course Registrations safely without duplicates
        foreach ($createdStudents as $student) {
            CourseRegistration::firstOrCreate([
                'student_id' => $student->id,
                'course_id' => $createdCourses[0]->id,
                'academic_year' => '2026/2027',
                'semester' => 1,
            ]);
        }
    }
}