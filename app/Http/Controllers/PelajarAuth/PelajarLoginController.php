<?php

namespace App\Http\Controllers\PelajarAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelajarLoginController extends Controller
{
    // Menampilkan halaman login pelajar
    public function showLoginForm()
    {
        return view('pelajar.auth.login');
    }

    // Proses login pelajar
    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        // Coba login menggunakan guard 'pelajar'
        if (Auth::guard('pelajar')->attempt($credentials)) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            
            return redirect()->intended(route('pelajar.home'));
        }

        // Jika gagal, kembali ke form dengan error dan input lama
        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    // Logout pelajar
    public function logout(Request $request)
    {
        Auth::guard('pelajar')->logout();

        // Invalidate dan regenerate token session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman welcome pelajar
        return redirect()->route('pelajar.welcome');
    }
}
