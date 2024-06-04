<?php

namespace App\Http\Controllers;

use App\Models\AlurMagang;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
        $this->param['data'] = AlurMagang::with('kelompok')
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
}
