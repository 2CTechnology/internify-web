<?php

namespace App\Http\Controllers;

use App\Models\PlotingDosen;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlotingDosenController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['header'] = 'Ploting Dosen';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->param['title'] = 'Ploting Dosen';
        $this->param['data'] = PlotingDosen::with('dosen')
            ->orderBy('status', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.ploting-dosen.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->param['title'] = 'Ploting Dosen - Tambah';
        $this->param['listDosen'] = User::where('role', 'Dosen')
            ->get();
            
        return view('backend.ploting-dosen.add', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_dosen' => 'required',
            'kota' => 'required',
            'tahun' => 'required',
            'jumlah_kelompok' => 'required',
        ], [
            'required' => ':attribute harus diisi.'
        ], [
            'id_dosen' => 'Dosen',
            'kota' => 'Kota',
            'tahun' => 'Tahun',
            'jumlah_kelompok' => 'Jumlah Kelompok',
        ]);

        DB::beginTransaction();
        try {
            $plotingDosen = new PlotingDosen();
            $plotingDosen->id_dosen = $request->id_dosen;
            $plotingDosen->tahun = $request->tahun;
            $plotingDosen->kota = $request->kota;
            $plotingDosen->jumlah_kelompok = $request->jumlah_kelompok;
            $plotingDosen->status = 1;
            $plotingDosen->created_at = now();
            $plotingDosen->save();
            DB::commit();

            return redirect()->route('ploting-dosen.ploting-dosen.index')->withStatus('Berhasil menambahkan data ploting dosen.');
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
        $data = PlotingDosen::findOrFail($id);
        if($data == null) {
            return redirect()->back()->withError('Terjadi kesalahan. Data tidak ditemukan.');
        }
        $this->param['title'] = 'Ploting Dosen - Edit';
        $this->param['listDosen'] = User::where('role', 'Dosen')
            ->get();
        $this->param['data'] = $data;
        return view('backend.ploting-dosen.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'id_dosen' => 'required',
            'kota' => 'required',
            'tahun' => 'required',
            'jumlah_kelompok' => 'required',
        ], [
            'required' => ':attribute harus diisi.'
        ], [
            'id_dosen' => 'Dosen',
            'kota' => 'Kota',
            'tahun' => 'Tahun',
            'jumlah_kelompok' => 'Jumlah Kelompok',
        ]);

        DB::beginTransaction();
        try {
            $plotingDosen = PlotingDosen::findOrFail($id);
            $plotingDosen->id_dosen = $request->id_dosen;
            $plotingDosen->tahun = $request->tahun;
            $plotingDosen->kota = $request->kota;
            $plotingDosen->jumlah_kelompok = $request->jumlah_kelompok;
            $plotingDosen->updated_at = now();
            $plotingDosen->save();
            DB::commit();

            return redirect()->route('ploting-dosen.ploting-dosen.index')->withStatus('Berhasil mengubah data ploting dosen.');
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
    $plotingDosen = PlotingDosen::findOrFail($id);

    DB::beginTransaction();
    try {
        $plotingDosen->delete();
        DB::commit();
        return redirect()->route('ploting-dosen.ploting-dosen.index')->withStatus('Berhasil menghapus data ploting dosen.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
    } catch (QueryException $e) {
        DB::rollBack();
        return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
    }
}

    public function showImport() {
        $this->param['title'] = 'Ploting Dosen - Import';
            
        return view('backend.ploting-dosen.import', $this->param);
    }

    public function storeImport(Request $request) {
        DB::beginTransaction();
        try {
            $idDosen = explode(',', $request->id_dosen);
            $kota = explode(',', $request->kota);
            $tahun = explode(',', $request->tahun);
            $jumlahKelompok = explode(',', $request->jumlah_kelompok);
            $dataInserted = [];

            foreach ($idDosen as $key => $item) {
                array_push($dataInserted, [
                    'id_dosen' => $item,
                    'kota' => $kota[$key],
                    'tahun' => $tahun[$key],
                    'jumlah_kelompok' => $jumlahKelompok[$key],
                    'status' => 1,
                    'created_at' => now()
                ]);
            }

            PlotingDosen::insert($dataInserted);
            DB::commit();
            return redirect()->route('ploting-dosen.ploting-dosen.index')->withStatus('Berhasil menambahkan data ploting dosen.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
    }

    public function getDosenByNIDN (Request $request) {
        try {
            $nidn = $request->get('no_identitas');
            $nidnReq = collect(json_decode($nidn, true));
            $nidnId = $nidnReq->pluck('no_identitas')->toArray();
            
            $data = User::where('role', 'Dosen')
                ->whereIn('no_identitas', $nidnId)
                ->get();
            $response = $nidnReq->map(function ($value) use ($data) {
                $nidn = $value['no_identitas'];
                $row = $value['row'];

                $nidnExists = $data->where('no_identitas', $nidn)->first();

                return [
                    'row' => $row,
                    'no_identitas' => $nidnExists ? $nidnExists->no_identitas : $nidn,
                    'cek_nidn' => $nidnExists ? true : false,
                    'nama' => $nidnExists ? $nidnExists->name : 'Dosen Tidak Ditemukan.',
                    'id_dosen' => $nidnExists ? $nidnExists->id : null
                ];
            })->toArray();
            
            return response()->json($response);
        } catch (Exception $e) {
            return $e;
        } 
    }
}
