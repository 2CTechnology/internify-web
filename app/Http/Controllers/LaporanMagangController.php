<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlurMagang;
use App\Models\LaporanMagang;
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

        if (auth()->user()->role == 'Dosen') {
            $data = LaporanMagang::select('id_kelompok','laporan', 'status_laporan')
                ->orderBy('id','desc')
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
