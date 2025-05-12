<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlurMagang;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

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
        //
    }
}
