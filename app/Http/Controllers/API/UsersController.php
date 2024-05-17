<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Kelompok;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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
                ->with([
                    'kelompok',
                    'kelompok.anggota'
                ])
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

    public function register(Request $request) {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->get('nama');
            $user->no_identitas = $request->get('no_identitas');
            $user->email = $request->get('email');
            $user->password = $request->get('password');
            $user->angkatan = $request->get('angkatan');
            $user->golongan = $request->get('golongan');
            $user->prodi_id = $request->get('prodi_id');
            $user->is_accepted = 0;
            $user->role = 'Mahasiswa';
            $user->created_at = now();
            $user->save();
            $userId = $user->id;

            $kelompok = new Kelompok();
            $kelompok->nama_kelompok = $request->get('nama_kelompok');
            $kelompok->id_users = $userId;
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
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
        } catch (QueryException $e) {
            DB::rollBack();
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
        } finally {
            $response = [
                'message' => $message
            ];

            return response()->json($response, $responseCode);
        }
    }
}
