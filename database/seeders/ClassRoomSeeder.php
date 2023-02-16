<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classRooms = array(
            array(
                'school_year_id' => 1,
                'class' => 'XI',
                'name' => 'XI IPS 1',
                'teacher_id' => 1,
                'students' => array(
                    1
                )
            )
        );

        foreach ($classRooms as $classRoom) {
            $classRoomCreated = ClassRoom::create([
                'school_year_id' => $classRoom['school_year_id'],
                'class' => $classRoom['class'],
                'name' => $classRoom['name'],
                'teacher_id' => $classRoom['teacher_id']
            ]);
            $classRoomCreated->students()->sync($classRoom['students']);
        };
    }
}
