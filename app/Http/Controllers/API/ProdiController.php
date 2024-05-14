<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{
    public function get(Request $request) {
        $message = '';
        $data = null;
        $responseCode = Response::HTTP_BAD_REQUEST;

        try {
            if ($request->has('id')) {
                $data = DB::table('mst_prodi')
                    ->where('id', $request->get('id'))
                    ->first();
            } else {
                $data = DB::table('mst_prodi')
                    ->get();
            }

            $message = 'Berhasil menampilkan prodi';
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
}
