<?php

namespace App\Http\Controllers;

use App\Models\FileTemplate;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileTemplateController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'File Template';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->param['title'] = 'FAQ';
        $this->param['data'] = FileTemplate::orderBy('id', 'desc')
            ->get();

        return view('backend.file-template.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->param['title'] = 'File Template - Tambah';
        return view('backend.file-template.add', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_template' => 'required',
            'file_template' => 'required'
        ], [
            'required' => ':attribute Harus diisi.'
        ], [
            'nama_template' => 'nama_template',
            'file_template' => 'file_template',
        ]);

        DB::beginTransaction();
        try {
            $file = $request->file('file_template');
            $filename = $file->getClientOriginalName();
            $filePath = public_path() . '/upload/file-template/' . Str::slug($request->nama_template);
            if(!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 493, true);
            }
            $file->move($filePath, $filename);
            $fileTemplate = new FileTemplate();
            $fileTemplate->nama_file = $request->nama_template;
            $fileTemplate->file = '/upload/file-template/' . Str::slug($request->nama_template) . '/' . $filename;
            $fileTemplate->save();
            DB::commit();

            return redirect()->route('file-template.index')->withStatus('Berhasil menambahkan data file template.');
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
        $this->param['title'] = 'File Template - Edit';
        $this->param['data'] = FileTemplate::findOrFail($id);
            
        return view('backend.file-template.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_template' => 'required',
        ], [
            'required' => ':attribute Harus diisi.'
        ], [
            'nama_template' => 'nama_template',
        ]);

        DB::beginTransaction();
        try {
            $fileTemplate = FileTemplate::findOrFail($id);
            $file = $request->file('file_template');
            if($file != null) {
                $filename = $file->getClientOriginalName();
                $filePath = public_path() . '/upload/file-template/' . Str::slug($request->nama_template);
                if(!File::isDirectory($filePath)) {
                    File::makeDirectory($filePath, 493, true);
                }
                $file->move($filePath, $filename);
                $fileTemplate->file = '/upload/file-template/' . Str::slug($request->nama_template) . '/' . $filename;
                if($fileTemplate->file != null) {
                    unlink(public_path() . $fileTemplate->file);
                }
            }
            $fileTemplate->nama_file = $request->nama_template;
            $fileTemplate->save();
            DB::commit();

            return redirect()->route('file-template.index')->withStatus('Berhasil menambahkan data file template.');
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
            $fileTemplate = FileTemplate::findOrFail($id);
            if($fileTemplate->file != null) {
                unlink(public_path() . $fileTemplate->file);
            }
            $fileTemplate->delete();

            DB::commit();
            return redirect()->route('file-template.index')->withStatus('Berhasil menghapus data file template.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
    }
}
