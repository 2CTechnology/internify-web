<?php
namespace App\Http\Controllers;

use App\Models\JadwalBimbingan;
use App\Models\Kelompok; // Pastikan model Kelompok diimpor
use Illuminate\Http\Request;

class BimbinganController extends Controller
{
    // Method untuk menampilkan halaman Bimbingan
    public function index()
    {
        // Ambil data jadwal bimbingan dari database (jika ada)
        $data = JadwalBimbingan::all(); // Mengambil semua data jadwal bimbingan

        // Ambil semua data kelompok untuk dropdown
        $kelompoks = Kelompok::all(); // Ambil semua data kelompok
        
        $param['title'] = 'Bimbingan';
        $param['header'] = 'bimbingan';
        $param['data'] = $data; // Mengirim data ke view
        $param['kelompoks'] = $kelompoks; // Mengirim data kelompok ke view
        
        return view('backend.bimbingan.index', $param);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jadwal' => 'required|date', // Pastikan format tanggal valid
            'catatan' => 'nullable|string', // Catatan opsional
            'id_kelompok' => 'required|exists:kelompoks,id', // Validasi bahwa id_kelompok ada di tabel kelompoks
        ]);

        // Simpan data ke tabel jadwal_bimbingans
        JadwalBimbingan::create([
            'jadwal' => $validated['jadwal'],
            'catatan' => $validated['catatan'],
            'id_kelompok' => $validated['id_kelompok'], // Menyertakan id_kelompok
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('bimbingan.index')->with('success', 'Jadwal bimbingan berhasil ditambahkan.');
    }
}
