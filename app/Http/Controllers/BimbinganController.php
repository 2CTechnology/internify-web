<?php

namespace App\Http\Controllers;

use App\Models\JadwalBimbingan;
use App\Models\Kelompok;
use App\Models\User;
use App\Services\FirebaseNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BimbinganController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'Akun Mahasiswa';
    }

    public function index()
    {
        $data = JadwalBimbingan::with('kelompok')->get();
        $kelompoks = Kelompok::all();

        $param['title'] = 'Bimbingan';
        $param['header'] = 'bimbingan';
        $param['data'] = $data;
        $param['kelompoks'] = $kelompoks;

        return view('backend.bimbingan.index', $param);
    }

    public function create()
    {
        $this->param['title'] = 'Jadwal Bimbingan - Tambah';
        $this->param['header'] = 'Tambah Bimbingan';
        $this->param['kelompoks'] = Kelompok::all();

        return view('backend.bimbingan.modal.add-bimbingan', $this->param);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'jadwal' => 'required|date',
        'catatan' => 'nullable|string',
        'id_kelompok' => 'required|exists:kelompoks,id',
    ]);

    Log::info('🔥 Memulai penyimpanan jadwal bimbingan.');

    // Simpan jadwal
    JadwalBimbingan::create([
        'jadwal' => $validated['jadwal'],
        'catatan' => $validated['catatan'],
        'id_kelompok' => $validated['id_kelompok'],
    ]);

    Log::info('✅ Jadwal berhasil disimpan. Coba ambil user untuk notifikasi...');

    // Ambil user dari kelompok yang dituju
    $users = User::whereHas('kelompok', function ($query) use ($validated) {
        $query->where('id', $validated['id_kelompok']);
    })->whereNotNull('fcm_token')->get();

    Log::info('📨 Jumlah user dengan FCM token: ' . $users->count());

    // Kirim notifikasi ke masing-masing user
    $notifier = new FirebaseNotificationService();

    foreach ($users as $user) {

                Log::info('📤 Mengirim notifikasi ke user ID ' . $user->id . ' dengan token: ' . $user->fcm_token);

        $notifier->sendToDevice(
            $user->fcm_token,
            'Jadwal Bimbingan Baru',
            'Bimbingan pada ' . date('d M Y H:i', strtotime($validated['jadwal']))
        );
    }

    return redirect()->route('bimbingan.index')->with('success', 'Jadwal bimbingan berhasil ditambahkan.');
}

    public function edit(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:jadwal_bimbingans,id',
            'ubah_status' => 'required|in:pending,selesai',
        ]);

        $bimbingan = JadwalBimbingan::find($request->id);
        $bimbingan->status = $request->ubah_status;
        $bimbingan->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bimbingan = JadwalBimbingan::find($id);

        if (!$bimbingan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $bimbingan->delete();

        return redirect()->route('bimbingan.index')->with('success', 'Jadwal bimbingan berhasil dihapus.');
    }

    public function sendNotifikasiBimbingan(Request $request)
    {
        $user = User::find($request->user_id);
        $token = $user->fcm_token;

        if (!$token) {
            return response()->json(['message' => 'User belum punya token']);
        }

        $firebase = new FirebaseNotificationService();
        $firebase->sendToDevice($token, 'Bimbingan Baru', 'Ada jadwal bimbingan jam 20.00');

        return response()->json(['message' => 'Notifikasi dikirim']);
    }
}