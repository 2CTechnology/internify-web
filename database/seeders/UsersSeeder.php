<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')
            ->insert([
                'name' => 'Ex Dosen',
                'no_identitas' => 'd1234',
                'email' => 'dosen123@mail.com',
                'password' => Hash::make('12345678'),
                'role' => 'Dosen'
            ]);

        DB::table('users')
            ->insert([
                'name' => 'Ex Admin',
                'no_identitas' => 'd1234',
                'email' => 'admin123@mail.com',
                'password' => Hash::make('12345678'),
                'role' => 'Admin'
            ]);

        DB::table('users')
            ->insert([
                'name' => 'Hafidz Fadhillah Febrianto',
                'no_identitas' => 'd1234',
                'email' => 'hafidzfadhillah606@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'Mahasiswa',
                'prodi_id' => 1,
                'angkatan' => '2024'
            ]);

        DB::table('users')
            ->insert([
                'name' => 'Rayasya',
                'no_identitas' => 'd1234',
                'email' => 'rayasya.dziqi@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'Mahasiswa',
                'prodi_id' => 1,
                'angkatan' => '2022'
            ]);
    }
}
