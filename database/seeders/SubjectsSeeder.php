<?php

namespace Database\Seeders;

use App\Models\Subjects;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = array(
            array(
                'name' => 'Matematika',
                'group' => 'Kelompok A (Umum)'
            ),
            array(
                'name' => 'Bahasa Indonesia',
                'group' => 'Kelompok A (Umum)'
            )
        );

        foreach ($subjects as $subject) {
            Subjects::create([
                'name' => $subject['name'],
                'group' => $subject['group']
            ]);
        };
    }
}
