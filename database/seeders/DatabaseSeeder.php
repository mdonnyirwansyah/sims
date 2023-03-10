<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            AdministratorSeeder::class,
            StudentSeeder::class,
            TeacherSeeder::class,
            SchoolYearSeeder::class,
            SubjectsSeeder::class,
            ClassRoomSeeder::class,
            DaySeeder::class,
            LessonScheduleSeeder::class,
            // ReportSeeder::class
        ]);
    }
}
