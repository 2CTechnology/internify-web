<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DospemController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'Dosen Pembimbing';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->param['title'] = 'Dosen Pembimbing';
        $this->param['data'] = DB::table('users')
            ->where('role', 'Dosen')
            ->get();
            
        return view('backend.dospem.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->param['title'] = 'Dosen Pembimbing - Tambah';
        return view('backend.dospem.add', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'nidn' => 'required',
            'foto' => 'required|image',
            'no_telp' => 'required',
            'password' => 'required|min:8',
        ], [
            'required' => ':attribute Harus diisi.',
            'image' => ':attribute Harus berupa gambar.',
        ], [
            'nama' => 'Nama',
            'email' => 'Email',
            'nidn' => 'NIDN',
            'foto' => 'Foto',
            'no_telp' => 'No. Telp',
        ]);

        DB::beginTransaction();
        try {
            $file = $request->file('foto');
            $filename = $file->getClientOriginalName();
            $filePath = public_path() . '/upload/foto-dosen/' . Str::slug($request->nama);
            if(!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 493, true);
            }
            $file->move($filePath, $filename);
            $user = new User();
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->no_identitas = $request->nidn;
            $user->no_telp = $request->no_telp;
            $user->foto = '/upload/foto-dosen/' . Str::slug($request->nama) . '/' . $filename;
            $user->password = Hash::make($request->password);
            $user->role = 'Dosen';
            $user->save();
            DB::commit();

            return redirect()->route('dospem.index')->withStatus('Berhasil menambahkan data dosen pembimbing.');
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
        $this->param['title'] = 'Dosen Pembimbing - Edit';
        $this->param['data'] = User::findOrFail($id);
        return view('backend.dospem.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'nidn' => 'required',
            'no_telp' => 'required',
            'password' => 'required',
        ], [
            'required' => ':attribute Harus diisi.'
        ], [
            'nama' => 'Nama',
            'email' => 'Email',
            'nidn' => 'NIDN',
            'no_telp' => 'No. Telp',
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            if($request->file('foto') != null) {
                $file = $request->file('foto');
                $filename = $file->getClientOriginalName();
                $filePath = public_path() . '/upload/foto-dosen/' . Str::slug($request->nama);
                if(!File::isDirectory($filePath)) {
                    File::makeDirectory($filePath, 493, true);
                }

                if($user->foto != null) {
                    unlink(public_path() . $user->foto);
                }
                $file->move($filePath, $filename);
                $user->foto = '/upload/foto-dosen/' . Str::slug($request->nama) . '/' . $filename;
            }
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->no_identitas = $request->nidn;
            $user->no_telp = $request->no_telp;
            $user->password = Hash::make($request->password);
            $user->role = 'Dosen';
            $user->save();
            DB::commit();

            return redirect()->route('dospem.index')->withStatus('Berhasil mengubah data dosen pembimbing.');
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
            $user->delete();
            DB::commit();

            return redirect()->route('dospem.index')->withStatus('Berhasil menghapus dosen pembimbing.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
    }
}
