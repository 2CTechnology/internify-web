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

        if (auth()->user()->role == 'Prodi') {
            $data = AlurMagang::with('kelompok')
                ->with('kelompok.anggota.prodi')
                ->with('kelompok.ketua.prodi')
                ->with('tempatMagang')
                ->select('id', 'id_kelompok', 'id_tempat_magang', 'status_surat_balasan')
                ->whereNotNull('proposal')
                ->orderBy('id', 'desc')
                ->get();
        }

        $this->param['data'] = $data;

        return view('backend.data-mahasiswa.index', $this->param);
    }
}
