<?php

namespace App\Http\Controllers;

use App\Models\AlurMagang;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'Proposal Magang';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->param['title'] = 'Akun Mahasiswa';
        $this->param['data'] = AlurMagang::with('kelompok')
            ->with('kelompok.anggota')
            ->with('kelompok.ketua')
            ->with('kelompok.dospem')
            ->whereNotNull('alur_magangs.proposal')
            ->orderBy('id', 'desc')
            ->get();
            
        return view('backend.proposal.index', $this->param);
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
