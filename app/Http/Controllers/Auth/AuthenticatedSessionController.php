<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse // Menangani proses login dan redirect berdasarkan role user
{
    $request->authenticate(); // Melakukan proses autentikasi (cek email dan password)
    $request->session()->regenerate(); // Regenerasi session untuk mencegah session fixation attack

    $role = auth()->user()->role; // Mengambil role dari user yang berhasil login

    // Mengecek role user dan mengarahkan ke halaman dashboard sesuai role
    if ($role === 'manager') {
        return redirect()->route('manager.dashboard'); // Jika role adalah manager, arahkan ke dashboard manager
    } elseif ($role === 'admin') {
        return redirect()->route('admin.dashboard_admin'); // Jika role adalah admin, arahkan ke dashboard admin
    } else {
        return redirect()->route('dashboard'); // Jika bukan admin atau manager, arahkan ke dashboard user biasa
    }
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
