<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array(
                "role_id" => 2,
                "name" => "Thomas Abiansah, M. Pd.",
                "username" => "197312122003121001",
                "password" => "197312122003121001",
                "teacher" => array(
                    "nip" => "197312122003121001",
                        "education" => "-"
            )
            ),
            array(
                "role_id" => 2,
                "name" => "Fitri Handayani, S. Pd.",
                "username" => "197312122003121002",
                "password" => "197312122003121002",
                "teacher" => array(
                    "nip" => "197312122003121002",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Rifa Suryasi, S. Pd.",
                "username" => "197312122003121003",
                "password" => "197312122003121003",
                "teacher" => array(
                    "nip" => "197312122003121003",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Rahmawati, S. Pd.",
                "username" => "197312122003121004",
                "password" => "197312122003121004",
                "teacher" => array(
                    "nip" => "197312122003121004",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Rifa'i, S. Pd.",
                "username" => "197312122003121005",
                "password" => "197312122003121005",
                "teacher" => array(
                    "nip" => "197312122003121005",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Mislinawati, S. Pd.",
                "username" => "197312122003121006",
                "password" => "197312122003121006",
                "teacher" => array(
                    "nip" => "197312122003121006",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Sri Wahyuni, S. Pd.",
                "username" => "197312122003121007",
                "password" => "197312122003121007",
                "teacher" => array(
                    "nip" => "197312122003121007",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Yossi Media Feri S, S. Pd.",
                "username" => "197312122003121008",
                "password" => "197312122003121008",
                "teacher" => array(
                    "nip" => "197312122003121008",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Edmawati, S. Sos.",
                "username" => "197312122003121009",
                "password" => "197312122003121009",
                "teacher" => array(
                    "nip" => "197312122003121009",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Risna Vondewi, S. Kom.",
                "username" => "197312122003121010",
                "password" => "197312122003121010",
                "teacher" => array(
                    "nip" => "197312122003121010",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Eci Suryani, S. Pd.",
                "username" => "197312122003121011",
                "password" => "197312122003121011",
                "teacher" => array(
                    "nip" => "197312122003121011",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Peni Novia P, S. Pd.",
                "username" => "197312122003121012",
                "password" => "197312122003121012",
                "teacher" => array(
                    "nip" => "197312122003121012",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Rita Erdat, S. Pd.",
                "username" => "197312122003121013",
                "password" => "197312122003121013",
                "teacher" => array(
                    "nip" => "197312122003121013",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Riska Firmanila, S. Pd.",
                "username" => "197312122003121014",
                "password" => "197312122003121014",
                "teacher" => array(
                    "nip" => "197312122003121014",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Nurfitri, S. Pd.",
                "username" => "197312122003121015",
                "password" => "197312122003121015",
                "teacher" => array(
                    "nip" => "197312122003121015",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Anita Linda Julita S, S. Pd.",
                "username" => "197312122003121016",
                "password" => "197312122003121016",
                "teacher" => array(
                    "nip" => "197312122003121016",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Sumiati, S. Pd.",
                "username" => "197312122003121017",
                "password" => "197312122003121017",
                "teacher" => array(
                    "nip" => "197312122003121017",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Lela Fetriani, S. Sos.",
                "username" => "197312122003121018",
                "password" => "197312122003121018",
                "teacher" => array(
                    "nip" => "197312122003121018",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Sri Puja Astuti, S. Pd.",
                "username" => "197312122003121019",
                "password" => "197312122003121019",
                "teacher" => array(
                    "nip" => "197312122003121019",
                    "education" => "-"
                )
            ),
            array(
                "role_id" => 2,
                "name" => "Seria BR Sitepu, S. S.",
                "username" => "197312122003121020",
                "password" => "197312122003121020",
                "teacher" => array(
                    "nip" => "197312122003121020",
                    "education" => "-"
                )
            )
        );

        foreach ($users as $user) {
            $userCreated = User::create([
                "role_id" => $user['role_id'],
                "name" => $user['name'],
                "username" => $user['username'],
                "password" => Hash::make($user['password'])
            ]);
            $userCreated->teacher()->create([
                "nip" => $user['teacher']['nip'],
                "education" => $user['teacher']['education']
            ]);
        };
    }
}
