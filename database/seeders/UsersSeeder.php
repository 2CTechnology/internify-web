use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'email' => 'dosen123@mail.com',
                'name' => 'Ex Dosen',
                'role' => 'Dosen',
            ],
            [
                'email' => 'admin123@mail.com',
                'name' => 'Ex Admin',
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
                'angkatan' => '2024'
            ],
            [
                'email' => 'rayasya.dziqi@gmail.com',
                'name' => 'Rayasya',
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
                        'no_identitas' => 'd1234',
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
