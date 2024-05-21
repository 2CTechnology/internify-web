<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkunMahasiswaController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'Akun Mahasiswa';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->param['title'] = 'Akun Mahasiswa';
        $this->param['data'] = User::where('role', 'Mahasiswa')
            ->with('prodi')
            ->orderBy('id', 'desc')
            ->get();
            
        // return $this->param;
        return view('backend.akun-mahasiswa.index', $this->param);
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
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->is_accepted = 1;
            $user->save();
            DB::commit();

            return redirect()->route('akun-mahasiswa.index')->withStatus('Berhasil mengonfirmasi akun mahasiswa.');
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
            $user = User::findOrFail($id);
            $user->is_accepted = 2;
            $user->save();
            DB::commit();

            return redirect()->route('akun-mahasiswa.index')->withStatus('Berhasil menolak akun mahasiswa.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
    }
}
