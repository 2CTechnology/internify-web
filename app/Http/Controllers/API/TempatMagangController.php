<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TempatMagang;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TempatMagangController extends Controller
{
    public function get(Request $request) {
        $message = '';
        $data = null;
        $responseCode = Response::HTTP_BAD_REQUEST;

        try {
            $id = $request->get('id');
            if ($id != null) {
                $data = TempatMagang::findOrFail($id);
            } else {
                $data = TempatMagang::orderBy('id', 'desc')
                    ->get();
            }
            $responseCode = Response::HTTP_OK;
            $message = 'Berhasil menampilkan data tempat magang.';
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
