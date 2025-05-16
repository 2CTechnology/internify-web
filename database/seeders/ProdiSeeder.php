use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $prodis = [
            'Teknik Informatika',
            'Manajemen Informatika',
            'Teknik Komputer',
            'Bisnis Digital'
        ];

        foreach ($prodis as $prodi) {
            DB::table('mst_prodi')->updateOrInsert(
                ['nama_prodi' => $prodi],
                ['created_at' => now()]
            );
        }
    }
}
