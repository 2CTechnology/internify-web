<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Kelompok;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class KelompokController extends Controller
{
    public function createKelompok (Request $request) {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $kelompok = new Kelompok();
            $kelompok->nama_kelompok = $request->get('nama_kelompok');
            $kelompok->id_users = auth()->user()->id;
            $kelompok->id_dospem = $request->get('id_dospem');
            $kelompok->created_at = now();
            $kelompok->save();
            $kelompokId = $kelompok->id;

            $anggotas = [];
            foreach($request->get('anggota') as $key => $item) {
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

    public function postKelompok (Request $request) {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {

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
                'data' => $data
            ];

            return response()->json($response, $responseCode);
        }
    }
    
    public function uploadProposal (Request $request) {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $idUser = auth()->user()->id;
            $file = $request->file('file_ketentuan');
            $filename = $file->getClientOriginalName();
            $filePath = public_path() . '/upload/proposal/' . $idUser;
            if(!File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 493, true);
            }
            $file->move($filePath, $filename);

            
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
                'data' => $data
            ];

            return response()->json($response, $responseCode);
        }
    }
}
