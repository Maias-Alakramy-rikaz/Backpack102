<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'Admin',
        ]);
        $admin->assignRole('Admin');

        $principal = User::factory()->create([
            'name' => 'NotAdmin',
            'email' => 'notadmin@example.com',
            'password' => 'Admin',
        ]);;
        $principal->assignRole('Principal');
        Teacher::factory(3)->create();
        Course::factory(5)->create();
        Student::factory(3)->create();
        CourseStudent::factory(6)->create();
    }
}
