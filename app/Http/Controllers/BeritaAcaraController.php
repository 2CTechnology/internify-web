<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\TempatMagang;
use App\Models\Prodi;
use Illuminate\Http\Request;

class BeritaAcaraController extends Controller
{
    public function index()
    {
        // Mengambil semua data berita acara
        $data = BeritaAcara::with('tempatMagang')->get(); // Mengambil berita acara beserta data tempat magangnya
        $tempatMagangs = TempatMagang::all();
        $prodis = Prodi::all();

        // Menyiapkan parameter untuk view
        $param['title'] = 'Berita Acara';
        $param['header'] = 'Daftar Berita Acara';
        $param['data'] = $data;
        $param['tempat_magangs'] = $tempatMagangs;
        $param['mst_prodi'] = $prodis;

        // Mengembalikan tampilan dengan parameter
        return view('backend.berita-acara.index', $param);
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'jadwal' => 'required|date',
            'tempat_magang_id' => 'required|exists:tempat_magangs,id',
            'prodi' => 'required',
            'jurusan' => 'required',
            'alamat' => 'required',
            'keterangan' => 'required',
            'catatan' => 'nullable|string',  // Memastikan catatan bisa kosong
        ]);

        // Membuat dan menyimpan data berita acara
        BeritaAcara::create([
            'jadwal' => $validated['jadwal'],
            'tempat_magang_id' => $validated['tempat_magang_id'],
            'prodi' => $validated['prodi'],
            'jurusan' => $validated['jurusan'],
            'alamat' => $validated['alamat'],
            'keterangan' => $validated['keterangan'],
            'catatan' => $validated['catatan'] ?? '', // Jika tidak ada, set ke string kosong
        ]);

        // Redirect setelah berhasil menyimpan
        return redirect()->route('berita-acara.index')->with('success', 'Data berhasil disimpan');
    }
}
