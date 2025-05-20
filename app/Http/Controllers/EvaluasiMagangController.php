<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatMagang;
use App\Models\EvaluasiMagang;
use Barryvdh\DomPDF\Facade\Pdf;

class EvaluasiMagangController extends Controller
{
    // Menampilkan form input evaluasi
    public function index()
    {
        $param = [
            'title' => 'Evaluasi Tempat Magang',
            'header' => 'Evaluasi Magang',
            'tempat_magangs' => TempatMagang::all()
        ];

        return view('backend.evaluasi-magang.index', $param);
    }

    // Menyimpan data evaluasi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tempat_magang_id' => 'required|exists:tempat_magangs,id',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan evaluasi baru
        $evaluasi = EvaluasiMagang::create([
            'tempat_magang_id' => $validated['tempat_magang_id'],
            'tanggal' => $validated['tanggal'],
            'keterangan' => $validated['keterangan'] ?? '',
        ]);

        // Redirect ke halaman index dan simpan ID terakhir untuk kebutuhan link download
        return redirect()->route('evaluasi-magang.index')
                         ->with('success', 'Evaluasi Magang berhasil disimpan')
                         ->with('last_id', $evaluasi->id); // <-- penting untuk tombol download
    }

    // Generate PDF berdasarkan ID evaluasi
    public function generatePdf($id)
    {
        $evaluasi = EvaluasiMagang::with('tempatMagang')->findOrFail($id);

        $pdf = Pdf::loadView('backend.evaluasi-magang.pdf', compact('evaluasi'))
                  ->setPaper('A4', 'portrait');

        return $pdf->stream('evaluasi-magang-' . $evaluasi->id . '.pdf');
    }
}
