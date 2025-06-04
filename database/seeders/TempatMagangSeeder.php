<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TempatMagangSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            [
                'posisi' => 'Front-End Programmer',
                'deskripsi_pekerjaan' => 'Menguasai CSS, Bootstrap, Tailwind, dan ReactJS.',
                'deskripsi_perusahaan' => 'Perusahaan yang bergerak di bidang teknologi informasi, fokus pada pengembangan aplikasi web dan mobile.'
            ],
            [
                'posisi' => 'Back-End Programmer',
                'deskripsi_pekerjaan' => 'Menguasai PHP, Laravel, NodeJS, dan database MySQL.',
                'deskripsi_perusahaan' => 'Perusahaan yang bergerak di bidang teknologi informasi, fokus pada pengembangan aplikasi web dan mobile.'
            ],
            [
                'posisi' => 'Design UI/UX',
                'deskripsi_pekerjaan' => 'Mendesain antarmuka pengguna yang menarik dan mudah digunakan, menggunakan Figma atau Adobe XD.',
                'deskripsi_perusahaan' => 'Perusahaan yang bergerak di bidang teknologi informasi, fokus pada pengembangan aplikasi web dan mobile.'
            ],
        ];

        foreach ($positions as $data) {
            DB::table('tempat_magangs')->updateOrInsert(
                [
                    'nama_tempat' => 'JV Partner Indonesia',
                    'posisi' => $data['posisi']
                ],
                [
                    'alamat' => 'Komplek Pertokoan Sawojajar Blok C22, Sawojajar, Kota Malang, Jawa Timur 56138',
                    'kriteria' => 'Problem Solving, Analisis Data, Komunikasi Efektif',
                    'deskripsi_pekerjaan' => $data['deskripsi_pekerjaan'],
                    'deskripsi_perusahaan' => $data['deskripsi_perusahaan'],
                    'website' => 'https://www.jvpartner.id/',
                    'employee_size' => 100,
                    'head_office' => 'Komplek Pertokoan Sawojajar Blok C22, Sawojajar, Kota Malang, Jawa Timur 56138',
                    'since' => 2000,
                    'specialization' => 'Software Development',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
