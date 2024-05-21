<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'FAQ';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->param['title'] = 'FAQ';
        $this->param['data'] = Faq::orderBy('id', 'desc')
            ->get();
            
        return view('backend.faq.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->param['title'] = 'FAQ - Tambah';
            
        return view('backend.faq.add', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ], [
            'required' => ':attribute Harus diisi.'
        ], [
            'pertanyaan' => 'Pertanyaan',
            'jawaban' => 'Jawaban',
        ]);

        DB::beginTransaction();
        try {
            Faq::insert([
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => $request->jawaban,
                'created_at' => now()
            ]);
            DB::commit();

            return redirect()->route('faq.index')->withStatus('Berhasil menambahkan data FAQ.');
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
        $this->param['title'] = 'FAQ - Edit';
        $this->param['data'] = Faq::findOrFail($id);
            
        return view('backend.faq.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ], [
            'required' => ':attribute Harus diisi.'
        ], [
            'pertanyaan' => 'Pertanyaan',
            'jawaban' => 'Jawaban',
        ]);

        DB::beginTransaction();
        try {
            Faq::where('id', $id)
                ->update([
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => $request->jawaban,
                'created_at' => now()
            ]);
            DB::commit();

            return redirect()->route('faq.index')->withStatus('Berhasil mengubah data FAQ.');
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
            $faq = Faq::findOrFail($id);
            $faq->delete();

            DB::commit();
            return redirect()->route('faq.index')->withStatus('Berhasil menghapus data FAQ.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
    }
}
