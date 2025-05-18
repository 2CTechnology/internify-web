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
                'deskripsi_pekerjaan' => 'F Lorem ipsum dolor...',
                'deskripsi_perusahaan' => 'F Lorem ipsum dolor...'
            ],
            [
                'posisi' => 'Back-End Programmer',
                'deskripsi_pekerjaan' => 'B Lorem ipsum dolor...',
                'deskripsi_perusahaan' => 'B Lorem ipsum dolor...'
            ],
            [
                'posisi' => 'Design UI/UX',
                'deskripsi_pekerjaan' => 'D Lorem ipsum dolor...',
                'deskripsi_perusahaan' => 'D Lorem ipsum dolor...'
            ],
        ];

        foreach ($positions as $data) {
            DB::table('tempat_magangs')->updateOrInsert(
                [
                    'nama_tempat' => 'JV Partner Indonesia',
                    'posisi' => $data['posisi']
                ],
                [
                    'alamat' => 'Komplek Pertokoan Sawojajar Jalan Danau Toba Blok C22, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 56138',
                    'kriteria' => 'Problem Solving, Analisis Data, Komunikasi Efektif',
                    'deskripsi_pekerjaan' => $data['deskripsi_pekerjaan'],
                    'deskripsi_perusahaan' => $data['deskripsi_perusahaan'],
                    'website' => 'https://www.jvpartner.id/',
                    'employee_size' => 1000,
                    'head_office' => 'Komplek Pertokoan Sawojajar Jalan Danau Toba Blok C22, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 56138',
                    'since' => 2000,
                    'specialization' => 'Affiliate Network Partnership',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
