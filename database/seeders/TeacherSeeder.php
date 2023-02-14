<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'role_id' => 2,
                'name' => 'Budi, S. Pd.',
                'username' => '197312122003121003',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'teacher' => array(
                    'nip' => '197312122003121003',
                    'education' => 'S1 Pendidikan Bahasa Indonesia'
                ),
                'detail' => array(
                    'place_of_birth' => 'Lubuk Mandian Gajah',
                    'date_of_birth' => '2005-12-04',
                    'gender' => 'Male',
                    'religion' => 'Islam'
                ),
                'address' => array(
                    'address' => 'Lubuk Mandian Gajah',
                    'email' => 'budi@gmail.com',
                    'phone' => '082286677886'
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
                $teacher_created = $user_created->teacher()->create([
                    'nip' => $user['teacher']['nip'],
                    'education' => $user['teacher']['education']
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

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        };
    }
}
