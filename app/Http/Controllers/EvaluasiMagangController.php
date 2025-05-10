<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatMagang;
use App\Models\EvaluasiMagang;

class EvaluasiMagangController extends Controller
{
    public function index()
    {
        // Mengambil semua data tempat magang
        $tempatMagangs = TempatMagang::all();

        // Siapkan parameter untuk view
        $param['title'] = 'Evaluasi Tempat Magang';
        $param['header'] = 'Evaluasi Magang';
        $param['tempat_magangs'] = $tempatMagangs;

        // Mengembalikan tampilan dengan parameter
        return view('backend.evaluasi-magang.index', $param);
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'tempat_magang_id' => 'required|exists:tempat_magangs,id',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Membuat dan menyimpan data evaluasi magang
        EvaluasiMagang::create([
            'tempat_magang_id' => $validated['tempat_magang_id'],
            'tanggal' => $validated['tanggal'],
            'keterangan' => $validated['keterangan'] ?? '', // Jika tidak ada, set ke string kosong
        ]);

        // Redirect setelah berhasil menyimpan
        return redirect()->route('evaluasi-magang.index')->with('success', 'Evaluasi Magang berhasil disimpan');
    }
}
