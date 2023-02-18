<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = array(
            array(
                'student_id' => 1,
                'semester' => '2 (dua)',
                'class_room_id' => 1,
                'type' => 'Pengetahuan',
                'grades' => array(
                    array(
                        'subjects_id' => 1,
                        'value' => 80,
                        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti pariatur et dolore laboriosam praesentium eius soluta aliquid distinctio molestiae doloremque.'
                    ),
                    array(
                        'subjects_id' => 2,
                        'value' => 90,
                        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti pariatur et dolore laboriosam praesentium eius soluta aliquid distinctio molestiae doloremque.'
                    )
                )
            )
        );

        foreach ($reports as $report) {
            $reportCreated = Report::create([
                'student_id' => $report['student_id'],
                'semester' => $report['semester'],
                'class_room_id' => $report['class_room_id'],
                'type' => $report['type']
            ]);

            $reportCreated->grades()->createMany($report['grades']);
        }
    }
}
