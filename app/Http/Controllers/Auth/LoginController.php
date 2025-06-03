<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Setelah login berhasil, redirect user sesuai role.
     */
    protected function authenticated(Request $request, $user)
    {
        // Cegah akses Mahasiswa
        if ($user->role === 'Mahasiswa') {
            Auth::logout();

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Akses ditolak. Mahasiswa tidak diperbolehkan login ke dashboard ini.'
                ], 403);
            }

            return redirect('/login')->withErrors([
                'email' => 'Akses ditolak. Mahasiswa tidak diperbolehkan login ke dashboard ini.'
            ]);
        }
    }

    /**
     * Redirect user berdasarkan rolenya menggunakan named route.
     */
    protected function redirectTo()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'Admin':
                return route('akun-mahasiswa.index');
            case 'Dosen':
                return route('berita-acara.index');
            case 'Prodi':
                return route('data-mahasiswa.index');
            default:
                return route('errors.404'); 
        }
    }

    /**
     * Buat instance controller baru.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Logout dan invalidate session.
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }
}