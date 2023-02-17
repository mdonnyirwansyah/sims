<?php

namespace Database\Seeders;

use App\Models\LessonSchedule;
use Illuminate\Database\Seeder;

class LessonScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lessonSchedules = array(
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 1,
                'teacher_id' => 1,
                'subjects_id' => 1,
                'day_id' => 1,
                'start_time' => '08:00:00',
                'end_time' => '09:30:00'
            )
        );

        foreach ($lessonSchedules as $lessonSchedule) {
            LessonSchedule::create([
                'school_year_id' => $lessonSchedule['school_year_id'],
                'semester' => $lessonSchedule['semester'],
                'class_room_id' => $lessonSchedule['class_room_id'],
                'teacher_id' => $lessonSchedule['teacher_id'],
                'subjects_id' => $lessonSchedule['subjects_id'],
                'day_id' => $lessonSchedule['day_id'],
                'start_time' => $lessonSchedule['start_time'],
                'end_time' => $lessonSchedule['end_time']
            ]);
        }
    }
}
