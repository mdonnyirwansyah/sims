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
                "school_year_id" => 1,
                "class" => "X",
                "name" => "X 1",
                "teacher_id" => 1
            ),
            array(
                "school_year_id" => 1,
                "class" => "X",
                "name" => "X 2",
                "teacher_id" => 2
            ),
            array(
                "school_year_id" => 1,
                "class" => "X",
                "name" => "X 3",
                "teacher_id" => 3
            ),
            array(
                "school_year_id" => 1,
                "class" => "X",
                "name" => "X 4",
                "teacher_id" => 4
            ),
            array(
                "school_year_id" => 1,
                "class" => "X",
                "name" => "X 5",
                "teacher_id" => 5
            ),
            array(
                "school_year_id" => 1,
                "class" => "XI",
                "name" => "XI IPA 1",
                "teacher_id" => 6
            ),
            array(
                "school_year_id" => 1,
                "class" => "XI",
                "name" => "XI IPA 2",
                "teacher_id" => 7
            ),
            array(
                "school_year_id" => 1,
                "class" => "XI",
                "name" => "XI IPA 3",
                "teacher_id" => 8
            ),
            array(
                "school_year_id" => 1,
                "class" => "XI",
                "name" => "XI IPS 1",
                "teacher_id" => 9
            ),
            array(
                "school_year_id" => 1,
                "class" => "XI",
                "name" => "XI IPS 2",
                "teacher_id" => 10
            ),
            array(
                "school_year_id" => 1,
                "class" => "XII",
                "name" => "XII IPS 1",
                "teacher_id" => 11
            ),
            array(
                "school_year_id" => 1,
                "class" => "XII",
                "name" => "XII IPS 2",
                "teacher_id" => 12
            ),
            array(
                "school_year_id" => 1,
                "class" => "XII",
                "name" => "XII IPS 3",
                "teacher_id" => 13
            ),
            array(
                "school_year_id" => 1,
                "class" => "XII",
                "name" => "XII IPA 1",
                "teacher_id" => 14
            ),
            array(
                "school_year_id" => 1,
                "class" => "XII",
                "name" => "XII IPA 2",
                "teacher_id" => 15
            )
        );

        foreach ($classRooms as $classRoom) {
            $classRoomCreated = ClassRoom::create([
                "school_year_id" => $classRoom['school_year_id'],
                "class" => $classRoom['class'],
                "name" => $classRoom['name'],
                "teacher_id" => $classRoom['teacher_id']
            ]);
        };
    }
}
