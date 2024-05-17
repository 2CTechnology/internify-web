<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

    public function lupaPassword(Request $request) {
        $message = '';
        $data = null;
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $user = User::where('email', $request->get('email'))
                ->first();
            if($user != null) {
                $otp = random_int(1000, 9999);
                DB::table('otp_lupa_password')
                    ->insert([
                        'id_user' => $user->id,
                        'otp' => $otp,
                        'created_at' => now()
                    ]);
                $data = [
                    'otp' => $otp,
                    'id_user' => $user->id
                ];
                Mail::to($user->email)->send(new OTPMail($data));
                $message = 'Berhasil generate OTP lupa password.';
                
                DB::commit();
            } else {
                $message = 'Email tidak dapat ditemukan.';
                $data = null;
            }
            $responseCode = Response::HTTP_OK;
        } catch (Exception $e) {
            DB::rollBack();
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
        } catch (QueryException $e) {
            DB::rollBack();
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
        } finally {
            $response = [
                'message' => $message,
                'data' => $data
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function cekOTP(Request $request) {
        $data = null;
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $otp = $request->get('otp');
            $cek = DB::table('otp_lupa_password')
                ->where('otp', $otp)
                ->where('status', 1)
                ->first();

            if($cek != null) {
                DB::table('otp_lupa_password')
                    ->where('otp', $otp)
                    ->where('status', 1)
                    ->update([
                        'status' => 0,
                        'updated_at' => now()
                    ]);
                $message = 'OTP berhasil terverifikasi.';
                DB::commit();
            } else {
                $message = 'OTP tidak dapat ditemukan.';
            }
        } catch (Exception $e) {
            DB::rollBack();
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
        } catch (QueryException $e) {
            DB::rollBack();
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
        } finally {
            $response = [
                'message' => $message
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function resetPassword (Request $request) {
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            DB::table('users')
                ->where('id', $request->get('id'))
                ->update([
                    'password' => Hash::make($request->get('password')),
                    'updated_at' => now()
                ]);
            DB::commit();
            $message = 'Berhasil mengubah password.';
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
