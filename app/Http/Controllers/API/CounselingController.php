<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalBimbingan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Anggota;
use App\Models\LaporanMagang;

class CounselingController extends Controller
{
    public function getBimbingan()
    {
        $jadwalBimbingan = JadwalBimbingan::select('jadwal', 'catatan', 'id_kelompok')->get();

    return response()->json([
        'success' => true,
        'data' => $jadwalBimbingan
    ]);
    
    }

    public function postLaporan(Request $request)
{
    $user = Auth::user();

    // Ambil anggota berdasarkan user login
    $anggota = Anggota::where('id_user', $user->id)->first();

    if (!$anggota || !$anggota->id_kelompok) {
        return response()->json([
            'success' => false,
            'message' => 'Data kelompok tidak ditemukan untuk pengguna ini.'
        ], 404);
    }

    $idKelompok = $anggota->id_kelompok;

    // Validasi PDF
    $validator = Validator::make($request->all(), [
        'laporan' => 'required|mimes:pdf|max:2048', 
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Simpan file ke storage
    if ($request->hasFile('laporan')) {
        $file = $request->file('laporan');
        $path = $file->store('laporan-magang', 'public'); 
    }

    // Simpan ke database
    $laporan = new LaporanMagang();
    $laporan->id_kelompok = $idKelompok;
    $laporan->laporan = $path; // simpan path PDF
    $laporan->save();

    return response()->json([
        'success' => true,
        'message' => 'Laporan berhasil diunggah.',
        'data' => $laporan
    ]);
}

}
