<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 40; $i++) { 
            $nis = $faker->randomNumber(5, true);
            $nisn = $faker->randomNumber(8, true);

            $userCreated = User::create([
                "role_id" => 3,
                "name" => $faker->name(),
                "username" => $nisn,
                "password" => Hash::make($nisn)
            ]);
            $userCreated->student()->create([
                "nis" => $nis,
                "nisn" => $nisn,
                "class_now" => "X",
                "class_at" => "X",
                "registered_at" => "2020/06/05"
            ]);
        }
    }
}
