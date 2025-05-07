<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlurMagang;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
        } else if(auth()->user()->role == 'Prodi') {
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
        return view('backend.surat-pelaksanaan.index', $this->param);
    }

    public function update(Request $request)
{
    try {
        $alur = AlurMagang::findOrFail($request->id);
        $alur->status_surat_pelaksanaan = 'dibuat'; // Ganti sesuai nama kolom di database
        $alur->save();

        return redirect()->back()->with('success', 'Surat pelaksanaan berhasil ditandai.');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan.');
    }
}

}
