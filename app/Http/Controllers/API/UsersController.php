<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function login(Request $request) {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        try {
            $user = User::where('email', $request->get('email'))
                ->where('role', 'Mahasiswa')
                ->first();
            if($user != null) {
                if(Hash::check($request->get('password'), $user->password)){
                    $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
                    $data = [
                        'user' => $user,
                        'token' => $token
                    ];
                    $responseCode = Response::HTTP_OK;
                    $message = 'Berhasil login.';
                } else {
                    $data = [
                        'user' => null,
                        'token' => null
                    ];
                    $responseCode = Response::HTTP_OK;
                    $message = 'Password salah.';
                }
            } else {
                $data = [
                    'user' => null,
                    'token' => null
                ];
                $responseCode = Response::HTTP_OK;
                $message = 'Email salah.';
            }
        } catch (Exception $e) {
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = [
                'user' => null,
                'token' => null
            ];
        } catch (QueryException $e) {
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = [
                'user' => null,
                'token' => null
            ];
        } 
        finally {
            $response = [
                'message' => $message,
                'data' => $data
            ];
            return response()->json($response, $responseCode);
        }
    }
}
