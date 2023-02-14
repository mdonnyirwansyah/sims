<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
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
                'role_id' => 3,
                'name' => 'Ilham Akbar Arya Suardi',
                'username' => '0058213504',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'student' => array(
                    'nis' => '2174',
                    'nisn' => '0058213504',
                    'class_now' => 'X',
                    'class_at' => 'X',
                    'registered_at' => '2020-06-05'
                ),
                'detail' => array(
                    'place_of_birth' => 'Lubuk Mandian Gajah',
                    'date_of_birth' => '2005-12-04',
                    'gender' => 'Male',
                    'religion' => 'Islam'
                ),
                'address' => array(
                    'address' => 'Lubuk Mandian Gajah',
                    'email' => 'ilham.akbar@gmail.com',
                    'phone' => '082217869798'
                ),
                'families' => array(
                    array(
                        'type' => 'Father',
                        'name' => 'Asad',
                        'occupation' => 'Petani',
                        'address' => array(
                            'address' => 'Lubuk Mandian Gajah',
                            'phone' => '082208977988'
                        )
                    ),
                    array(
                        'type' => 'Mother',
                        'name' => 'Reni Arianti',
                        'occupation' => 'IRT (Ibu Rumah Tangga)'
                    )
                )
            )
        );

        foreach ($users as $user) {
            try {
                $user_created = User::create([
                    'role_id' => $user['role_id'],
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'password' => $user['password']
                ]);
                $student_created = $user_created->student()->create([
                    'nis' => $user['student']['nis'],
                    'nisn' => $user['student']['nisn'],
                    'class_now' => $user['student']['class_now'],
                    'class_at' => $user['student']['class_at'],
                    'registered_at' => $user['student']['registered_at']
                ]);
                $user_created->user_detail()->create([
                    'place_of_birth' => $user['detail']['place_of_birth'],
                    'date_of_birth' => $user['detail']['date_of_birth'],
                    'gender' => $user['detail']['gender'],
                    'religion' => $user['detail']['religion']
                ]);
                $user_created->address()->create([
                    'address' => $user['address']['address'],
                    'email' => $user['address']['email'],
                    'phone' => $user['address']['phone']
                ]);
                $families = [];
                foreach ($user['families'] as $index => $family) {
                    $families[$index] = [
                        'type' => $family['type'],
                        'name' => $family['name'],
                        'occupation' => $family['occupation']
                    ];
                }
                $family_created = $student_created->families()->createMany($families);
                $family_created[0]->address()->create([
                    'address' => $user['families'][0]['address']['address'],
                    'phone' => $user['families'][0]['address']['phone']

                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        };
    }
}
