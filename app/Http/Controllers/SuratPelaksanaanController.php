<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlurMagang;
use Exception;
use App\Services\FirebaseNotificationService;
use Illuminate\Support\Facades\Log;

class SuratPelaksanaanController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'Surat Pelaksanaan';
    }

    public function index()
    {
        $this->param['title'] = 'form Surat Pelaksanaan';

        // Ambil data hanya untuk role Prodi
        if (auth()->user()->role == 'Prodi') {
            $data = AlurMagang::with(['kelompok', 'kelompok.anggota', 'kelompok.ketua', 'kelompok.dospem', 'kelompok.ketua.prodi', 'kelompok.anggota.prodi', 'tempatMagang'])
                ->whereNotNull('alur_magangs.proposal')
                ->where('alur_magangs.status_proposal', 'diterima')
                ->orderBy('id', 'desc')
                ->get();

            $this->param['data'] = $data;
        } else {
            // Jika bukan Prodi, tidak ada data dikembalikan
            $this->param['data'] = collect(); // atau -> [] untuk array kosong
        }

        return view('backend.surat-pelaksanaan.index', $this->param);
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:alur_magangs,id',
            ]);

            $alurMagang = AlurMagang::find($request->id);

            $alurMagang->surat_pelaksanaan = 'surat pelaksanaan telah dibuat';
            $alurMagang->updated_at = now();
            $alurMagang->save();

            // kirim notif
            $ketua = $alurMagang->kelompok->ketua;
            if ($ketua && $ketua->fcm_token) {
                $notifier = new FirebaseNotificationService();
                $notifier->sendToDevice($ketua->fcm_token, 'Surat Penerimaan Terbit', 'Surat penerimaan magang kamu telah diterbitkan.');
                Log::info('Notifikasi surat penerimaan terkirim ke: ' . $ketua->name);
            }

            return redirect()->back()->with('success', 'Surat pelaksanaan berhasil ditandai.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan.');
        }
    }
}