<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlotingDosen;
use App\Models\Kelompok;
use App\Models\User;
use App\Models\TempatMagang;
use App\Models\Prodi;

class AssignDospemController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'Assign Dosen';
    }

    /**
     * Halaman daftar hasil assign dosen
     */
    public function index()
    {
        $this->param['title'] = 'Ploting Dosen';
        $this->param['data'] = PlotingDosen::with('dosen')
            ->orderBy('status', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.assign-dospem.index', $this->param);
    }

    /**
     * Form untuk assign dosen ke kelompok berdasarkan tempat & prodi
     */
public function assignForm()
{
    $eligibleCombinations = Kelompok::select('id_tempat', 'id_prodi')
        ->whereNull('id_dospem') // belum di-assign dospem
        ->whereNotNull('id_users') // sudah keterima
        ->groupBy('id_tempat', 'id_prodi')
        ->get()
        ->map(function ($item) {
            $item->tempat = TempatMagang::find($item->id_tempat);
            $item->prodi = Prodi::find($item->id_prodi);
            return $item;
        });

    $dosenList = User::where('role', 'dosen')->get();

    return view('backend.assign-dospem.assign-form', [
        'dosenList' => $dosenList,
        'eligibleCombinations' => $eligibleCombinations,
        'title' => 'Form Assign Dosen Pembimbing',
        'header' => 'Assign Dosen'
    ]);
}



    /**
     * Menyimpan hasil assign dosen ke kelompok
     */
public function store(Request $request)
{
    $request->validate([
        'id_tempat' => 'required|exists:tempat_magangs,id',
        'id_prodi' => 'required|exists:mst_prodi,id',
        'id_dosen' => 'required|exists:users,id',
        'jumlah_kelompok' => 'nullable|integer|min:1',
    ]);

    // Ambil kelompok yang sudah diterima dan belum punya dospem
    $query = Kelompok::where('id_tempat', $request->id_tempat)
        ->where('id_prodi', $request->id_prodi)
        ->whereNotNull('id_users')
        ->whereNull('id_dospem');

    if ($request->filled('jumlah_kelompok')) {
        $query->take($request->jumlah_kelompok);
    }

    $kelompoks = $query->get();

    if ($kelompoks->isEmpty()) {
        return back()->with('error', 'Tidak ada kelompok yang tersedia untuk di-assign.');
    }

    // Assign semua kelompok tersebut ke satu dosen
    foreach ($kelompoks as $kelompok) {
        $kelompok->update([
            'id_dospem' => $request->id_dosen,
        ]);
    }

    // Simpan info ke tabel ploting_dosen
    PlotingDosen::create([
        'id_dosen' => $request->id_dosen,
        'kota' => optional($kelompoks->first()->tempat)->alamat ?? 'Tidak diketahui',
        'tahun' => now()->year,
        'jumlah_kelompok' => $kelompoks->count(),
        'status' => true,
    ]);

    return redirect()->route('assign-dospem.form')->with('success', "{$kelompoks->count()} kelompok berhasil di-assign ke dosen.");
}



}
