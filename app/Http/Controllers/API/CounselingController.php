<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalBimbingan;

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
}
