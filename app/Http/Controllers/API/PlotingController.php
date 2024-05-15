<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PlotingController extends Controller
{
    public function getArea(Request $request) {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        try {
            $responseCode = Response::HTTP_OK;
            $message = 'Berhasil menampilkan area.';
            $data = DB::table('ploting_dosens')
                ->select(
                    'id',
                    'kota'
                )
                ->where('status', 1)
                ->get();
        } catch (Exception $e) {
            $data = null;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
        } catch (QueryException $e) {
            $data = null;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
        } finally {
            $response = [
                'message' => $message,
                'data' => $data
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function getDosenByArea(Request $request) {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        try {
            $kota = $request->get('kota');
            $responseCode = Response::HTTP_OK;
            $message = 'Berhasil menampilkan area.';
            $data = DB::table('ploting_dosens')
                ->join('users', 'users.id', 'ploting_dosens.id_dosen')
                ->select(
                    'ploting_dosens.id',
                    'kota',
                    'users.id as id_dospem',
                    'users.name'
                )
                ->where('status', 1)
                ->where('kota', 'LIKE', "%$kota%")
                ->get();
        } catch (Exception $e) {
            $data = null;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
        } catch (QueryException $e) {
            $data = null;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
        } finally {
            $response = [
                'message' => $message,
                'data' => $data
            ];

            return response()->json($response, $responseCode);
        }
    }
}
