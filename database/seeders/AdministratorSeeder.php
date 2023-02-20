<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_created = User::create([
            "role_id" => 1,
            "name" => "Administrator",
            "username" => "11223344",
            "password" => Hash::make("11223344")
        ]);
        $user_created->teacher()->create([
            "nip" => "11223344",
            "education" => "-"
        ]);
    }
}
