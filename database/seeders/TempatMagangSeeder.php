<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TempatMagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tempat_magangs')->insert([
            'nama_tempat' => 'JV Partner Indonesia',
            'posisi' => 'Front-End Programmer',
            'alamat' => 'Komplek Pertokoan Sawojajar Jalan Danau Toba Blok C22, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 56138',
            'deskripsi_pekerjaan' => 'F Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit repellendus fugit quis voluptatem mollitia deleniti ut architecto dolore, illum in debitis sequi nesciunt, blanditiis quae a recusandae. Dolores, expedita dolor.',
            'kriteria' => 'Problem Solving, Analisis Data, Komunikasi Efektif',
            'deskripsi_perusahaan' => 'F Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit repellendus fugit quis voluptatem mollitia deleniti ut architecto dolore, illum in debitis sequi nesciunt, blanditiis quae a recusandae. Dolores, expedita dolor.',
            'website' => 'https://www.jvpartner.id/',
            'employee_size' => 1000,
            'head_office' => 'Komplek Pertokoan Sawojajar Jalan Danau Toba Blok C22, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 56138',
            'since' => 2000,
            'specialization' => 'Affiliate Network Partnership',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tempat_magangs')->insert([
            'nama_tempat' => 'JV Partner Indonesia',
            'posisi' => 'Back-End Programmer',
            'alamat' => 'Komplek Pertokoan Sawojajar Jalan Danau Toba Blok C22, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 56138',
            'deskripsi_pekerjaan' => 'B Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit repellendus fugit quis voluptatem mollitia deleniti ut architecto dolore, illum in debitis sequi nesciunt, blanditiis quae a recusandae. Dolores, expedita dolor.',
            'kriteria' => 'Problem Solving, Analisis Data, Komunikasi Efektif',
            'deskripsi_perusahaan' => 'B Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit repellendus fugit quis voluptatem mollitia deleniti ut architecto dolore, illum in debitis sequi nesciunt, blanditiis quae a recusandae. Dolores, expedita dolor.',
            'website' => 'https://www.jvpartner.id/',
            'employee_size' => 1000,
            'head_office' => 'Komplek Pertokoan Sawojajar Jalan Danau Toba Blok C22, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 56138',
            'since' => 2000,
            'specialization' => 'Affiliate Network Partnership',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tempat_magangs')->insert([
            'nama_tempat' => 'JV Partner Indonesia',
            'posisi' => 'Design UI/UX',
            'alamat' => 'Komplek Pertokoan Sawojajar Jalan Danau Toba Blok C22, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 56138',
            'deskripsi_pekerjaan' => 'D Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit repellendus fugit quis voluptatem mollitia deleniti ut architecto dolore, illum in debitis sequi nesciunt, blanditiis quae a recusandae. Dolores, expedita dolor.',
            'kriteria' => 'Problem Solving, Analisis Data, Komunikasi Efektif',
            'deskripsi_perusahaan' => 'D Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit repellendus fugit quis voluptatem mollitia deleniti ut architecto dolore, illum in debitis sequi nesciunt, blanditiis quae a recusandae. Dolores, expedita dolor.',
            'website' => 'https://www.jvpartner.id/',
            'employee_size' => 1000,
            'head_office' => 'Komplek Pertokoan Sawojajar Jalan Danau Toba Blok C22, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 56138',
            'since' => 2000,
            'specialization' => 'Affiliate Network Partnership',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
