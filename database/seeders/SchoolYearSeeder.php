<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use Illuminate\Database\Seeder;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schoolYears = collect([
            '2022/2023'
        ]);

        $schoolYears->each(function ($schoolYear) {
            SchoolYear::create([
                'name' => $schoolYear
            ]);
        });
    }
}
