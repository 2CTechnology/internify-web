<?php

namespace App\Http\Controllers;

use App\Models\TempatMagang;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TempatMagangController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'Tempat Magang';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->param['title'] = 'Tempat Magang';
        $this->param['data'] = TempatMagang::orderBy('id', 'desc')
            ->get();
            
        return view('backend.tempat-magang.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->param['title'] = 'Tempat Magang - Tambah';
            
        return view('backend.tempat-magang.add', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_tempat' => 'required',
            'daerah' => 'required'
        ], [
            'required' => ':attribute Harus diisi.'
        ], [
            'nama_tempat' => 'Nama Tempat',
            'daerah' => 'Daerah',
        ]);

        DB::beginTransaction();
        try {
            TempatMagang::insert([
                'nama_tempat' => $request->nama_tempat,
                'daerah' => $request->daerah,
                'created_at' => now()
            ]);
            DB::commit();

            return redirect()->route('tempat-magang.index')->withStatus('Berhasil menambahkan data tempat magang.');
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
        $this->param['title'] = 'Tempat Magang - Edit';
        $this->param['data'] = TempatMagang::findOrFail($id);
            
        return view('backend.tempat-magang.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_tempat' => 'required',
            'daerah' => 'required'
        ], [
            'required' => ':attribute Harus diisi.'
        ], [
            'nama_tempat' => 'Nama Tempat',
            'daerah' => 'Daerah',
        ]);

        DB::beginTransaction();
        try {
            TempatMagang::where('id', $id)
                ->update([
                'nama_tempat' => $request->nama_tempat,
                'daerah' => $request->daerah,
                'created_at' => now()
            ]);
            DB::commit();

            return redirect()->route('tempat-magang.index')->withStatus('Berhasil mengubah data tempat magang.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $tempatMagang = TempatMagang::findOrFail($id);
            $tempatMagang->delete();

            DB::commit();
            return redirect()->route('tempat-magang.index')->withStatus('Berhasil menghapus data tempat magang.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
    }
}
