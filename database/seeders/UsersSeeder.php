<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'email' => 'dosen123@mail.com',
                'name' => 'Dosen Pembimbing',
                'role' => 'Dosen',
            ],
            [
                'email' => 'admin123@mail.com',
                'name' => 'Koordinator Magang',
                'role' => 'Admin',
            ],
            [
                'email' => 'adminprodi123@mail.com',
                'name' => 'Admin Prodi',
                'role' => 'Prodi',
            ],
            [
                'email' => 'hafidzfadhillah606@gmail.com',
                'name' => 'Hafidz Fadhillah Febrianto',
                'role' => 'Mahasiswa',
                'prodi_id' => 1,
                'angkatan' => '2022'
            ],
            [
                'email' => 'rayasya.dziqi@gmail.com',
                'name' => 'Rayasya Dziqi Cahyana',
                'role' => 'Mahasiswa',
                'prodi_id' => 1,
                'angkatan' => '2022'
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                array_merge(
                    [
                        'name' => $user['name'],
                        'no_identitas' => 'E41234567',
                        'password' => Hash::make('12345678'),
                        'role' => $user['role'],
                    ],
                    isset($user['prodi_id']) ? ['prodi_id' => $user['prodi_id']] : [],
                    isset($user['angkatan']) ? ['angkatan' => $user['angkatan']] : []
                )
            );
        }
    }
}
