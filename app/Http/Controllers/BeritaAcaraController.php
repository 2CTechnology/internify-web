<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\TempatMagang;
use App\Models\Prodi;
use Barryvdh\DomPDF\Facade\Pdf; // ✅ Gunakan namespace yang benar
use Illuminate\Http\Request;

class BeritaAcaraController extends Controller
{
    public function index()
    {
        $data = BeritaAcara::with('tempatMagang')->get();
        $tempatMagangs = TempatMagang::all();
        $prodis = Prodi::all();

        $param['title'] = 'Berita Acara';
        $param['header'] = 'Daftar Berita Acara';
        $param['data'] = $data;
        $param['tempat_magangs'] = $tempatMagangs;
        $param['mst_prodi'] = $prodis;

        return view('backend.berita-acara.index', $param);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jadwal' => 'required|date',
            'tempat_magang_id' => 'required|exists:tempat_magangs,id',
            'prodi' => 'required',
            'jurusan' => 'required',
            'alamat' => 'required',
            'keterangan' => 'required',
            'catatan' => 'nullable|string',
        ]);

        $berita = BeritaAcara::create([
            'jadwal' => $validated['jadwal'],
            'tempat_magang_id' => $validated['tempat_magang_id'],
            'prodi' => $validated['prodi'],
            'jurusan' => $validated['jurusan'],
            'alamat' => $validated['alamat'],
            'keterangan' => $validated['keterangan'],
            'catatan' => $validated['catatan'] ?? '',
        ]);

        return redirect()
            ->route('berita-acara.index')
            ->with('success', 'Data berhasil disimpan')
            ->with('last_id', $berita->id); // Mengirim ID yang baru saja disimpan
    }

    public function generatePDF($id)
    {
        $data = BeritaAcara::with('tempatMagang')->findOrFail($id);

        $pdf = Pdf::loadView('backend.berita-acara.pdf', compact('data'));

        return $pdf->download('berita_acara_' . $data->id . '.pdf');
    }
}
