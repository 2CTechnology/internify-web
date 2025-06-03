<?php

namespace App\Http\Controllers;

use App\Models\AlurMagang;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Services\FirebaseNotificationService;
use Illuminate\Support\Facades\Log;


class SuratBalasanController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'Surat Balasan';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->param['title'] = 'Surat Balasan';
        if(auth()->user()->role == 'Admin') {
            $data = AlurMagang::with('kelompok')
                ->with('kelompok.anggota')
                ->with('kelompok.ketua')
                ->with('kelompok.dospem')
                ->with('kelompok.ketua.prodi')
                ->with('kelompok.anggota.prodi')
                ->with('tempatMagang')
                ->whereNotNull('alur_magangs.proposal')
                ->where('alur_magangs.status_proposal', 'diterima')
                ->orderBy('id', 'desc')
                ->get();
        } else if(auth()->user()->role == 'Dosen') {
            $data = AlurMagang::with('tempatMagang')
                ->withWhereHas('kelompok', function($q) {
                    return $q->where('id_dospem', auth()->user()->id);
                })
                ->with('kelompok.anggota')
                ->with('kelompok.ketua')
                ->with('kelompok.dospem')
                ->with('kelompok.ketua.prodi')
                ->with('kelompok.anggota.prodi')
                ->whereNotNull('alur_magangs.proposal')
                ->where('alur_magangs.status_proposal', 'diterima')
                ->orderBy('id', 'desc')
                ->get();
        }
        $this->param['data'] = $data;
            // return $this->param;
        return view('backend.surat-balasan.index', $this->param);
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
        $validated = $request->validate([
            'surat_pengantar' => 'required'
        ], [
            'required' => ':attribute harus diisi.'
        ], [
            'surat_pengantar' => 'Surat Pengantar'
        ]);

        if(!$validated) {
            return redirect()->back()->withError('Surat Pengantar harus diisi.');
        }

        DB::beginTransaction();
        try {
            $id = $request->id;
            $file = $request->file('surat_pengantar');
            $filename = $file->getClientOriginalName();
            $filePath = public_path() . '/upload/surat-pengantar/' . $id;
            if(!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 493, true);
            }
            $file->move($filePath, $filename);

            $alurMagang = AlurMagang::findOrFail($id);
            $alurMagang->surat_pengantar = '/upload/surat-pengantar/' . $id . '/' . $filename;
            $alurMagang->updated_at = now();
            $alurMagang->save();

            //kirim notif
            $ketua = $alurMagang->kelompok->ketua;
            if ($ketua && $ketua->fcm_token) {
                $notifier = new FirebaseNotificationService();
                $notifier->sendToDevice(
                    $ketua->fcm_token,
                    'Surat Balasan Terbit',
                    'Surat balasan magangmu sudah diterbitkan. Silakan cek di aplikasi.'
                );
                Log::info("Notifikasi surat balasan terkirim ke: " . $ketua->name);
            }

            DB::commit();

            return redirect()->route('surat-balasan.index')->withStatus('Berhasil menambahkan surat proposal magang');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
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
        //
    }

public function tindakLanjut(Request $request)
{
    // validasi
    $request->validate([
        'id'     => 'required|integer|exists:alur_magangs,id',
        'status_surat_balasan' => 'required|in:diterima,mengulang',
    ]);

    DB::beginTransaction();
    
    try{
    // Ambil data berdasarkan ID
        $alurMagang = AlurMagang::find($request->id);

        if ($request->status_surat_balasan === 'mengulang') {
            $alurMagang->proposal = null;
            $alurMagang->status_proposal = 'belum ada';
            $alurMagang->revisi_proposal = null;
            $alurMagang->alasan_proposal_ditolak = null;
            $alurMagang->tempat_magang = null;
            $alurMagang->nama_posisi = null;
            $alurMagang->surat_balasan = null;
            $alurMagang->surat_pengantar = null;
        }

            // Update status
            $alurMagang->status_surat_balasan = $request->status_surat_balasan;
            $alurMagang->updated_at = now();
            $alurMagang->save();

            // Kirim notif
           
            $ketua = $alurMagang->kelompok->ketua;
                if ($ketua && $ketua->fcm_token) {
                    $notifier = new FirebaseNotificationService();

                    if ($request->status_surat_balasan === 'mengulang') {
                        $notifier->sendToDevice(
                            $ketua->fcm_token,
                            'Surat Balasan Ditolak',
                            'Surat balasanmu ditolak. Silakan unggah ulang proposal.'
                        );
                    } else {
                        $notifier->sendToDevice(
                            $ketua->fcm_token,
                            'Surat Balasan Diterima',
                            'Surat balasanmu diterima. Silahkan menunggu Surat Pelaksanaan Terbit dari admin prodi.'
                        );
                    }
                }
        DB::commit();
        return back()->with('success', 'Status surat balasan berhasil diperbarui.');
        }catch(Exception $e){
            DB::rollBack();
                return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        }catch (QueryException $e) {
                DB::rollBack();
                return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
    }

}
