<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\TempatMagang;
use App\Models\Prodi;
use App\Models\Kelompok;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BeritaAcaraController extends Controller
{
    public function index()
    {
        $data = BeritaAcara::with('tempatMagang')->get();
        $tempatMagangs = TempatMagang::all();
        $prodis = Prodi::all();
        $kelompoks = Kelompok::all();

        return view('backend.berita-acara.index', [
            'title' => 'Berita Acara',
            'header' => 'Daftar Berita Acara',
            'data' => $data,
            'tempat_magangs' => $tempatMagangs,
            'mst_prodi' => $prodis,
            'kelompoks' => $kelompoks,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jadwal' => 'required|date',
            'tempat_magang_id' => 'required|exists:tempat_magangs,id',
            'kelompok_id' => 'required|exists:kelompoks,id',
            'prodi' => 'required|string',
            // 'jurusan' => 'required|string', // tetap validasi karena dibutuhkan di form
            'alamat' => 'required|string',
            'keterangan' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $berita = BeritaAcara::create([
            'jadwal' => $validated['jadwal'],
            'tempat_magang_id' => $validated['tempat_magang_id'],
            'kelompok_id' => $validated['kelompok_id'],
            'prodi' => $validated['prodi'],
            // 'jurusan' => $validated['jurusan'], 
            'alamat' => $validated['alamat'],
            'keterangan' => $validated['keterangan'],
            'catatan' => $validated['catatan'] ?? '',
        ]);

        // Simpan jurusan di session untuk dipakai saat generate PDF
        // session(['berita_jurusan_' . $berita->id => $validated['jurusan']]);

        return redirect()
            ->route('berita-acara.index')
            ->with('success', 'Data berhasil disimpan')
            ->with('last_id', $berita->id);
    }

    public function generatePDF($id)
    {
        $berita = BeritaAcara::with(['tempatMagang', 'kelompok.anggota'])->findOrFail($id);

        // Ambil jurusan dari session
        // $jurusan = session('berita_jurusan_' . $id, ''); 

        // Kirim ke view PDF
        $pdf = Pdf::loadView('backend.berita-acara.pdf', [
            'berita' => $berita,
            // 'jurusan' => $jurusan
        ]);

        return $pdf->download('berita_acara_' . $berita->id . '.pdf');
    }

    public function showKelompokAnggota($namaKelompok)
    {
        $kelompok = Kelompok::where('nama_kelompok', $namaKelompok)->with('anggotas')->firstOrFail();

        return view('backend.berita-acara.kelompok', [
            'kelompok' => $kelompok,
            'anggotas' => $kelompok->anggotas,
        ]);
    }
}
