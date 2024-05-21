<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'Program Studi';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->param['title'] = 'Program Studi';
        $this->param['data'] = Prodi::orderBy('id', 'desc')
            ->get();
            
        return view('backend.prodi.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->param['title'] = 'Program Studi - Tambah';
            
        return view('backend.prodi.add', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prodi' => 'required',
        ], [
            'required' => ':attribute Harus diisi.'
        ], [
            'prodi' => 'Program Studi',
        ]);

        DB::beginTransaction();
        try {
            Prodi::insert([
                'nama_prodi' => $request->prodi,
                'created_at' => now()
            ]);
            DB::commit();

            return redirect()->route('prodi.index')->withStatus('Berhasil menambahkan data program studi.');
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
        $this->param['title'] = 'Program Studi - Edit';
        $this->param['data'] = Prodi::findOrFail($id);
            
        return view('backend.prodi.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validatedData = $request->validate([
            'prodi' => 'required',
        ], [
            'required' => ':attribute Harus diisi.'
        ], [
            'prodi' => 'Program Studi',
        ]);

        DB::beginTransaction();
        try {
            $prodi = Prodi::findOrFail($id);
            $prodi->nama_prodi = $request->prodi;
            $prodi->updated_at = now();
            $prodi->save();
            DB::commit();

            return redirect()->route('prodi.index')->withStatus('Berhasil mengubah data program studi.');
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
            $prodi = Prodi::findOrFail($id);
            $prodi->delete();

            DB::commit();
            return redirect()->route('prodi.index')->withStatus('Berhasil menghapus data Prodi.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
    }
}
