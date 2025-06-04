<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalBimbingan;
use App\Models\LaporanMagang;
use Illuminate\Support\Facades\DB;
use App\Models\Kelompok;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class CounselingController extends Controller
{
    public function getBimbingan($id)
    {
        $jadwalBimbingan = JadwalBimbingan::where('id_kelompok', $id)->select('jadwal', 'catatan', 'id_kelompok', 'status')->get();

        return response()->json([
            'success' => true,
            'data' => $jadwalBimbingan,
        ]);
    }

    public function postLaporan($id, Request $request)
{
    $request->validate([
        'laporan' => 'required|file|mimes:pdf,doc,docx|max:10240',
    ]);

    DB::beginTransaction();
    try {
        $kelompok = Kelompok::findOrFail($id);

        $file = $request->file('laporan');
        $originalName = trim($file->getClientOriginalName());
        $originalName = str_replace(["\n", "\r"], '', $originalName);

        $safeName = time() . '-' . $originalName;

        $path = public_path('uploads/laporan_magang/' . $kelompok->id);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Pindahkan file ke folder tujuan
        $file->move($path, $safeName);

        // Simpan path relatif dari file
        $filePath = '/uploads/laporan_magang/' . $kelompok->id . '/' . $safeName;

        // Simpan ke database
        $laporan = LaporanMagang::updateOrCreate(
            ['id_kelompok' => $kelompok->id],
            [
                'laporan' => $filePath,
                'status_laporan' => 'Belum Direview',
                'catatan' => null,
            ],
        );

        DB::commit();

        return response()->json([
            'message' => 'Berhasil upload laporan.',
            'data' => $laporan,
            'file_url' => asset($filePath),
        ], Response::HTTP_OK);

    } catch (\Throwable $e) {
        DB::rollBack();
        return response()->json([
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

}
