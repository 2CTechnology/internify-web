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

        if ($user) {
            // Cek status akun
            if ($user->is_accepted == 0 || is_null($user->is_accepted)) {
                $responseCode = Response::HTTP_FORBIDDEN;
                $message = 'Akun Anda belum dikonfirmasi.';
                $data = [
                    'user' => null,
                    'token' => null
                ];
            } elseif ($user->is_accepted == 2) {
                $responseCode = Response::HTTP_FORBIDDEN;
                $message = 'Akun Anda telah ditolak. Silakan hubungi admin.';
                $data = [
                    'user' => null,
                    'token' => null
                ];
            } elseif (Hash::check($request->get('password'), $user->password)) {
                $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
                $data = [
                    'token' => $token,
                    'user' => $user
                ];
                $responseCode = Response::HTTP_OK;
                $message = 'Login Success';
            } else {
                $responseCode = Response::HTTP_UNAUTHORIZED;
                $message = 'Password salah.';
                $data = [
                    'user' => null,
                    'token' => null
                ];
            }
        } else {
            $responseCode = Response::HTTP_UNAUTHORIZED;
            $message = 'Email tidak ditemukan.';
            $data = [
                'user' => null,
                'token' => null
            ];
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
    } finally {
        $response = [
            'status_code' => $responseCode,
            'message' => $message,
            'response' => $data
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
            // $user->no_identitas = $request->get('no_identitas');
            $user->email = $request->get('email');
            $user->password = $request->get('password');
            // $user->angkatan = $request->get('angkatan');
            // $user->golongan = $request->get('golongan');
            // $user->prodi_id = $request->get('prodi_id');
            // $user->no_telp = $request->get('no_telp');
            // $user->jenis_kelamin = strtolower($request->get('gender'));
            $user->role = 'Mahasiswa';
            $user->created_at = now();
            $user->save();
            
            DB::commit();
            $message = 'Account Successfully Created';
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
                'status_code' => $responseCode,
                'message' => $message,
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
                    'id_user' => $user->id,
                    'otp' => $otp,
                ];
                
                try{
                    Mail::to($user->email)->send(new OTPMail($data));
                }catch(\Exception $e){
                    DB::rollBack();
                    $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                    $message = 'Gagal mengirim email OTP: ' . $e->getMessage();
                    $data = null;

                // return lebih cepat (supaya di finally tidak tumpang tindih)
                return response()->json([
                    'status_code' => $responseCode,
                    'message' => $message,
                    'response' => $data
                    ], $responseCode);
                }

                // $responseCode = Response::HTTP_OK;
                // $message = 'We Have Sent OTP Code, Please Check Your Email';
                
                DB::commit();
            } else {
                $responseCode = Response::HTTP_UNAUTHORIZED;
                $message = 'Email Not Found';
                $data = null;
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
                'status_code' => $responseCode,
                'message' => $message,
                'response' => $data
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
                $responseCode = Response::HTTP_OK;
                $message = 'Code OTP Successfully Verified';
                $data = [
                    'id_user' => $cek->id_user,
                ];
                DB::commit();
            } else {
                $responseCode = Response::HTTP_NOT_FOUND;
                $message = 'Code OTP Not Found';
                $data = null;
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
                'status_code' => $responseCode,
                'message' => $message,
                'response' => $data
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function resetPassword (Request $request) {
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $user = User::where('id', $request->get('id'))
            ->first();
            if ($user != null) {
                DB::table('users')
                    ->where('id', $request->get('id'))
                    ->update([
                        'password' => Hash::make($request->get('password')),
                        'updated_at' => now()
                    ]);
                DB::commit();
                $responseCode = Response::HTTP_OK;
                $message = 'Successfully Changed Password';
            } else {
                $responseCode = Response::HTTP_NOT_FOUND;
                $message = 'User Not Found';
            }
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
                'status_code' => $responseCode,
                'message' => $message
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function dataUserById (Request $request) {
        $message = '';
        $data = null;
        $responseCode = Response::HTTP_BAD_REQUEST;

        try {
            $user = User::where('id', $request->get('id_user'))
            ->where('role', 'Mahasiswa')
            ->with([
                'kelompok',
                'kelompok.anggota',
            ])->first();

            if($user != null) {
                $responseUser = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'no_identitas' => $user->no_identitas,
                    'email' => $user->email,
                    'email_verified_at' => $user->email_verified_at,
                    'role' => $user->role,
                    'foto' => $user->foto,
                    'no_telp' => $user->no_telp,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'is_accepted' => $user->is_accepted,
                    'angkatan' => $user->angkatan,
                    'golongan' => $user->golongan,
                    'prodi_id' => $user->prodi_id,
                    'tanggal_lahir' => $user->tanggal_lahir,
                    'jenis_kelamin' => $user->jenis_kelamin,
                    'prodi_name' => $user->prodi ? $user->prodi->nama_prodi : null,
                    'kelompok' => $user->kelompok
                ];
    
                $data = $responseUser;
                $responseCode = Response::HTTP_OK;
                $message = 'Success';
            } else {
                $responseCode = Response::HTTP_NOT_FOUND;
                $message = 'User Not Found';
                $data = null;
            }
        } catch (Exception $e) {
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
        } catch (QueryException $e) {
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Terjadi kesalahan. ' . $e->getMessage();
            $data = null;
        } finally {
            $response = [
                'status_code' => $responseCode,
                'message' => $message,
                'response' => $data
            ];

            return response()->json($response, $responseCode);
        }
    }

    public function updateUser(Request $request) {
        $message = '';
        $responseCode = Response::HTTP_BAD_REQUEST;

        DB::beginTransaction();
        try {
            $user = User::where('id', $request->get('id'))
            ->first();
            if ($user != null) {
                DB::table('users')
                    ->where('id', $request->get('id'))
                    ->update([
                        'name' => $request->get('name'),
                        'no_identitas' => $request->get('nim'),
                        'email' => $request->get('email'),
                        'prodi_id' => $request->get('prodi_id'),
                        'no_telp' => $request->get('no_telp'),
                        'tanggal_lahir' => $request->get('tanggal_lahir'),
                        'jenis_kelamin' => strtolower($request->get('gender')),
                        'angkatan' => $request->get('angkatan'),
                        'golongan' => $request->get('golongan'),
                        'updated_at' => now()
                    ]);
                DB::commit();
                $responseCode = Response::HTTP_OK;
                $message = 'Successfully Update Profile';
            } else {
                $responseCode = Response::HTTP_NOT_FOUND;
                $message = 'User Not Found';
            }
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
                'status_code' => $responseCode,
                'message' => $message,
            ];

            return response()->json($response, $responseCode);
        }
    }
}
