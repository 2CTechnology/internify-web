<?php

namespace App\Http\Controllers;

use App\Models\AlurMagang;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $this->param['title'] = 'Proposal';
        if(auth()->user()->role == 'Admin') {
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
        }
        $this->param['data'] = $data;
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
        DB::beginTransaction();
        try {
            $alurMagang = AlurMagang::findOrFail($request->id);
            $alurMagang->status_proposal = $request->tindak_lanjut;
            if($request->revisi != null) {
                $alurMagang->revisi_proposal = $request->revisi;
            } 
            if($request->alasan_ditolak) {
                $alurMagang->alasan_proposal_ditolak = $request->alasan_ditolak;
            }
            $alurMagang->updated_at = now();
            $alurMagang->save();
            DB::commit();

            return redirect()->route('proposal.index')->withStatus('Berhasil menambahkan menindaklanjuti proposal.');
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

    public function download($id) {
        $proposal = AlurMagang::find($id);
        $file = public_path() . $proposal->proposal;
        
        return response()->download($file);
    }
}
