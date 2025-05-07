<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\AlurMagang;

class DataMahasiswaController extends Controller
{
   
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'Data Mahasiswa';
    }

    public function index()
    {
        $this->param['title'] = 'Data Mahasiswa';
        if (auth()->user()->role == 'Admin') {
            $data = AlurMagang::with('kelompok')
                ->with('kelompok.anggota')
                ->with('kelompok.ketua')
                ->with('kelompok.dospem')
                ->with('kelompok.ketua.prodi')
                ->with('kelompok.anggota.prodi')
                ->with('tempatMagang')
                ->whereNotNull('alur_magangs.proposal')
                ->orderBy('id', 'desc')
                ->get();
        } else if (auth()->user()->role == 'Dosen') {
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
                ->orderBy('id', 'desc')
                ->get();
        } else if (auth()->user()->role == 'Prodi') {
            $data = AlurMagang::with('kelompok')
                ->with('kelompok.anggota')
                ->with('kelompok.ketua')
                ->with('kelompok.dospem')
                ->with('kelompok.ketua.prodi')
                ->with('kelompok.anggota.prodi')
                ->with('tempatMagang')
                ->whereNotNull('alur_magangs.proposal')
                ->orderBy('id', 'desc')
                ->get();
        }
    
        $this->param['data'] = $data;
        
        // return $this->param;
        return view('backend.data-mahasiswa.index', $this->param);
    }
}
