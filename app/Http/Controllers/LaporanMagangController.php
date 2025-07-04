<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlurMagang;
use App\Models\LaporanMagang;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; 

class LaporanMagangController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'Laporan Magang';
    }
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
    $this->param['title'] = 'Laporan';

    if (auth()->user()->role == 'Dosen') {
        $data = LaporanMagang::with('kelompok:id,nama_kelompok') // eager load relasi
            ->select('id', 'id_kelompok', 'laporan', 'status_laporan')
            ->orderBy('id', 'desc')
            ->get();
    }

    $this->param['data'] = $data;

    return view('backend.laporan-magang.index', $this->param);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        $laporan = LaporanMagang::findOrFail($id);

        // Hapus file jika ada
        if ($laporan->laporan && file_exists(public_path($laporan->laporan))) {
            unlink(public_path($laporan->laporan));
        }

        $laporan->delete();

        return redirect()->route('laporan-magang.index')->with('success', 'Laporan berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->route('laporan-magang.index')->with('error', 'Terjadi kesalahan saat menghapus laporan.');
    }
    }

    public function tindakLanjut(Request $request)
{
    $request->validate([
        'id' => 'required|exists:laporan_magangs,id',
        'tindak_lanjut' => 'required|in:diterima,revisi',
        'catatan' => 'nullable|string',
    ]);

    try {
        $laporan = LaporanMagang::findOrFail($request->id);
        $laporan->status_laporan = $request->tindak_lanjut;
        $laporan->catatan = $request->tindak_lanjut === 'revisi' ? $request->catatan : null;
        $laporan->save();

        return redirect()->route('laporan-magang.index')->with('success', 'Tindak lanjut berhasil disimpan.');
    } catch (QueryException $e) {
        return redirect()->back()->withErrors('Terjadi kesalahan saat menyimpan data.');
    }
}


}
