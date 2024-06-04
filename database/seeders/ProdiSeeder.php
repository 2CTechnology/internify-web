<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mst_prodi')
        ->insert([
            'nama_prodi' => 'Teknik Informatika',
            'created_at' => now(),
        ]);

        DB::table('mst_prodi')
        ->insert([
            'nama_prodi' => 'Manajemen Informatika',
            'created_at' => now(),
        ]);

        DB::table('mst_prodi')
        ->insert([
            'nama_prodi' => 'Teknik Komputer',
            'created_at' => now(),
        ]);

        DB::table('mst_prodi')
        ->insert([
            'nama_prodi' => 'Bisnis Digital',
            'created_at' => now(),
        ]);
    }
}
