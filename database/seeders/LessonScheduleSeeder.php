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
                'class_room_id' => 10,
                'teacher_id' => 2,
                'subjects_id' => 1,
                'day_id' => 1,
                'start_time' => '08:00:00',
                'end_time' => '09:30:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 3,
                'subjects_id' => 2,
                'day_id' => 1,
                'start_time' => '09:45:00',
                'end_time' => '12:00:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 4,
                'subjects_id' => 3,
                'day_id' => 1,
                'start_time' => '12:45:00',
                'end_time' => '13:30:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 5,
                'subjects_id' => 4,
                'day_id' => 1,
                'start_time' => '13:30:00',
                'end_time' => '15:30:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 6,
                'subjects_id' => 5,
                'day_id' => 2,
                'start_time' => '08:00:00',
                'end_time' => '09:30:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 7,
                'subjects_id' => 6,
                'day_id' => 2,
                'start_time' => '09:45:00',
                'end_time' => '12:00:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 8,
                'subjects_id' => 7,
                'day_id' => 2,
                'start_time' => '12:45:00',
                'end_time' => '15:30:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 9,
                'subjects_id' => 8,
                'day_id' => 3,
                'start_time' => '08:00:00',
                'end_time' => '09:30:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 10,
                'subjects_id' => 9,
                'day_id' => 3,
                'start_time' => '09:45:00',
                'end_time' => '12:00:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 11,
                'subjects_id' => 10,
                'day_id' => 3,
                'start_time' => '12:45:00',
                'end_time' => '15:30:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 12,
                'subjects_id' => 11,
                'day_id' => 4,
                'start_time' => '08:00:00',
                'end_time' => '09:30:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 13,
                'subjects_id' => 12,
                'day_id' => 4,
                'start_time' => '09:45:00',
                'end_time' => '12:00:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 14,
                'subjects_id' => 13,
                'day_id' => 4,
                'start_time' => '12:45:00',
                'end_time' => '15:30:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 15,
                'subjects_id' => 14,
                'day_id' => 5,
                'start_time' => '08:00:00',
                'end_time' => '09:30:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 16,
                'subjects_id' => 15,
                'day_id' => 5,
                'start_time' => '09:45:00',
                'end_time' => '12:00:00'
            ),
            array(
                'school_year_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 10,
                'teacher_id' => 17,
                'subjects_id' => 16,
                'day_id' => 5,
                'start_time' => '12:45:00',
                'end_time' => '15:30:00'
            ),
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
