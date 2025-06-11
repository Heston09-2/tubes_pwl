<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Menampilkan form edit profil user yang sedang login.
     * 
     * Query SQL yang dijalankan:
     * SELECT * FROM users WHERE id = ?;
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(), // Mengambil data user yang sedang login
        ]);
    }

    /**
     * Memproses dan menyimpan pembaruan data profil user.
     * 
     * Query SQL yang dijalankan:
     * UPDATE users 
     * SET name = ?, email = ?, email_verified_at = ?, updated_at = NOW() 
     * WHERE id = ?;
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mengisi model user dengan data yang sudah tervalidasi
        $request->user()->fill($request->validated());

        // Jika user mengubah email, set email_verified_at menjadi null (harus verifikasi ulang)
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Simpan perubahan ke database
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Menghapus akun user.
     * 
     * Query SQL yang dijalankan:
     * SELECT * FROM users WHERE id = ?;
     * DELETE FROM users WHERE id = ?;
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        // Cek kecocokan password yang dimasukkan dengan yang tersimpan (hash)
        // Proses ini tidak langsung menggunakan query SQL, tapi menggunakan fungsi hashing di PHP.
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Kata sandi tidak cocok dengan catatan kami.']);
        }

        // Hapus data user dari tabel users
        $user->delete();

        // Logout user, menghapus session (bukan query SQL)
        auth()->logout();

        return redirect('/')->with('status', 'Akun Berhasil Dihapus.');
    }
}
