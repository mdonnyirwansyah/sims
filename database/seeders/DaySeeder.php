<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = collect([
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jum'at"
        ]);

        $days->each(function ($day) {
            Day::create([
                'name' => $day
            ]);
        });
    }
}
