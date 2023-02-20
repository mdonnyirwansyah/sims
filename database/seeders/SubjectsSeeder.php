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
                "name" => "Pendidikan Agama dan Budi Pekerti",
                "group" => "Kelompok A (Umum)"
            ),
            array(
                "name" => "Pendidikan Pencasila dan Kewarganegaraan",
                "group" => "Kelompok A (Umum)"
            ),
            array(
                "name" => "Bahasa Indonesia",
                "group" => "Kelompok A (Umum)"
            ),
            array(
                "name" => "Matematika",
                "group" => "Kelompok A (Umum)"
            ),
            array(
                "name" => "Sejarah Indonesia",
                "group" => "Kelompok A (Umum)"
            ),
            array(
                "name" => "Bahasa Inggris",
                "group" => "Kelompok A (Umum)"
            ),
            array(
                "name" => "Seni Budaya",
                "group" => "Kelompok B (Umum)"
            ),
            array(
                "name" => "Pendidikan Jasmani, Olah Raga, dan Kesehatan",
                "group" => "Kelompok B (Umum)"
            ),
            array(
                "name" => "Prakarya dan Kewirausahaan",
                "group" => "Kelompok B (Umum)"
            ),
            array(
                "name" => "Budaya Melayu Riau",
                "group" => "Kelompok B (Umum)"
            ),
            array(
                "name" => "Geografi",
                "group" => "Kelompok C (Peminatan)"
            ),
            array(
                "name" => "Sejarah",
                "group" => "Kelompok C (Peminatan)"
            ),
            array(
                "name" => "Sosiologi",
                "group" => "Kelompok C (Peminatan)"
            ),
            array(
                "name" => "Ekonomi",
                "group" => "Kelompok C (Peminatan)"
            ),
            array(
                "name" => "Biologi",
                "group" => "Kelompok C (Peminatan)"
            ),
            array(
                "name" => "Kimia",
                "group" => "Kelompok C (Peminatan)"
            ),
            array(
                "name" => "Matematika",
                "group" => "Kelompok C (Peminatan)"
            ),
            array(
                "name" => "Fisika",
                "group" => "Kelompok C (Peminatan)"
            ),
            array(
                "name" => "Bahasa dan Sastra Inggris",
                "group" => "Kelompok C (Peminatan)"
            )
        );

        foreach ($subjects as $subjects) {
            Subjects::create([
                "name" => $subjects['name'],
                "group" => $subjects['group']
            ]);
        };
    }
}
