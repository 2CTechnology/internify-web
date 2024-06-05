<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AlurMagang;
use App\Models\Anggota;
use App\Models\Kelompok;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use stdClass;

class KelompokController extends Controller
{
    public function createKelompok(Request $request)
    {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $kelompok = new Kelompok();
            $kelompok->nama_kelompok = $request->get('nama_kelompok');
            $kelompok->id_users = auth()->user()->id;
            $kelompok->created_at = now();
            $kelompok->save();
            $kelompokId = $kelompok->id;

            $anggotas = [];
            foreach ($request->get('anggota') as $key => $item) {
                array_push($anggotas, [
                    'nim' => $item['nim'],
                    'nama' => $item['nama'],
                    'id_prodi' => $item['id_prodi'],
                    'angkatan' => $item['angkatan'],
                    'golongan' => $item['golongan'],
                    'created_at' => now(),
                    'id_kelompok' => $kelompokId,
                ]);
            }
            Anggota::insert($anggotas);
            DB::commit();
            $message = 'Berhasil menambahkan data.';
            $responseCode = Response::HTTP_OK;
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'message' => $message,
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function InsertTempatMagang($id, Request $request)
    {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $alurMagang = new AlurMagang();
            $alurMagang->id_kelompok = $id;
            $alurMagang->tempat_magang = $request->get('tempat_magang');
            $alurMagang->status = null;
            $alurMagang->created_at = now();
            $alurMagang->save();

            DB::commit();
            $message = 'Berhasil menambahkan tempat magang.';
            $responseCode = Response::HTTP_OK;
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'message' => $message,
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function uploadProposal($id, Request $request)
    {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $alurMagang = AlurMagang::where('id_kelompok', $id)->first();

            $file = $request->file('proposal');
            $filename = $file->getClientOriginalName();
            $filePath = public_path() . '/upload/proposal/' . $id;
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 493, true);
            }
            $file->move($filePath, $filename);

            $alurMagang->proposal = '/upload/proposal/' . $id . '/' . $filename;
            $alurMagang->updated_at = now();
            $alurMagang->save();

            DB::commit();
            $message = 'Berhasil upload proposal.';
            $responseCode = Response::HTTP_OK;
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'message' => $message
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function uploadSuratBalasan($id, Request $request)
    {
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $alurMagang = AlurMagang::where('id_kelompok', $id)->first();

            $file = $request->file('surat_balasan');
            $filename = $file->getClientOriginalName();
            $filePath = public_path() . '/upload/surat-balasan/' . $id;
            if (!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 493, true);
            }
            $file->move($filePath, $filename);

            $alurMagang->surat_balasan = '/upload/surat-balasan/' . $id . '/' . $filename;
            $alurMagang->updated_at = now();
            $alurMagang->save();

            DB::commit();
            $message = 'Berhasil upload surat balasan.';
            $responseCode = Response::HTTP_OK;
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'message' => $message
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function getKelompokById()
    {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        try {
            $kelompok = Kelompok::with('anggota')
                ->where('id_users', auth()->user()->id)
                ->join('users as d', 'd.id', 'kelompoks.id_dospem')
                ->select(
                    'kelompoks.*',
                    'd.name'
                )
                ->first();

            $data = $kelompok;
            $message = 'Berhasil menampilkan kelompok.';
            $responseCode = Response::HTTP_OK;
        } catch (Exception $e) {
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'message' => $message,
                'data' => $data
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function insertDospem($id, Request $request)
    {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $kelompok = Kelompok::find($id);
            $kelompok->id_dospem = $request->get('id_dospem');
            $kelompok->updated_at = now();
            $kelompok->save();
            DB::commit();

            $message = 'Berhasil menambahkan dospem.';
            $responseCode = Response::HTTP_OK;
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'message' => $message,
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function cekStatus()
    {
        $data = null;
        $returnData = new stdClass;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        try {
            $userId = auth()->user()->id;
            $kelompok = Kelompok::where('id_users', $userId)->first();
            if (!$kelompok) {
                $data = null;
                $message = 'Data kelompok tidak ditemukan.';
                $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            }
            $alurMagang = AlurMagang::where('id_kelompok', $kelompok?->id)->first();
            if (!$alurMagang) {
                $returnData->message = 'Kelompok belum melakukan pemilihan tempat magang.';
                $returnData->dataAlurMagang = $alurMagang;
            } else if ($alurMagang) {
                // if ($)
            }
        } catch (Exception $e) {

        } catch (QueryException $e) {

        } finally {
            $response = [
                'message' => $message,
                'data' => $data,
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function InsertTempatMagangById($id, Request $request)
    {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $alurMagang = new AlurMagang();
            $alurMagang->id_kelompok = $id;
            $alurMagang->tempat_magang = $request->get('id_tempat_magang');
            $alurMagang->status = null;
            $alurMagang->created_at = now();
            $alurMagang->save();

            DB::commit();
            $message = 'Berhasil menambahkan tempat magang.';
            $responseCode = Response::HTTP_OK;
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } catch (QueryException $e) {
            DB::rollBack();
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        } finally {
            $response = [
                'message' => $message,
            ];

            return response()->json($response, $responseCode);
        }
    }
}
