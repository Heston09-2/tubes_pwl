<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PelajarController extends Controller
{
    // Menampilkan profil pelajar
    public function profile()
    {
        $pelajar = Auth::guard('pelajar')->user();
        return view('pelajar.profile.show', compact('pelajar'));
    }

    // Menampilkan form edit profil
    public function edit()
    {
        $pelajar = Auth::guard('pelajar')->user();
        return view('pelajar.profile.edit', compact('pelajar'));
    }

    // Menyimpan perubahan profil
  public function update(Request $request)
{
    $pelajar = Auth::guard('pelajar')->user();

    // Validasi dasar
    $request->validate([
        'name' => 'required|string|max:255',
        'umur' => 'required|integer',
        'pendidikan' => 'required|string|in:SD,SMP,SMA',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    // Jika user mengisi password baru
    if ($request->filled('password')) {
        // Pastikan password lama dimasukkan
        if (!$request->filled('current_password')) {
            return back()->withErrors(['current_password' => 'Password lama wajib diisi untuk mengganti password.']);
        }

        // Cek apakah password lama benar
        if (!Hash::check($request->current_password, $pelajar->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak cocok.']);
        }

        // Update password
        $pelajar->password = bcrypt($request->password);
    }

    // Update data lainnya
    $pelajar->name = $request->name;
    $pelajar->umur = $request->umur;
    $pelajar->pendidikan = $request->pendidikan;
    $pelajar->save();

    return back()->with('success', 'Profil berhasil diperbarui.');
}

    // Menghapus akun dengan verifikasi password
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $pelajar = Auth::guard('pelajar')->user();

        if (!Hash::check($request->password, $pelajar->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        Auth::guard('pelajar')->logout();
        $pelajar->delete();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
