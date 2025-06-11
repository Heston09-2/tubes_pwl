<?php

namespace App\Http\Controllers\PelajarAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Pelajar;

class PelajarRegisterController extends Controller
{
    // Tampilkan form register dengan pilihan kategori (minat)
    public function showRegisterForm()
    {
        $categories = Category::all();
        return view('pelajar.auth.register', ['minats' => $categories]);
    }

    // Proses registrasi pelajar
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pelajars,email',
            'password' => 'required|confirmed|min:6',
            'umur' => 'required|integer|min:5|max:100',
            'pendidikan' => 'required|string',
            'minat' => 'required|array|min:1',
            'minat.*' => 'exists:categories,id',
        ]);

        $pelajar = Pelajar::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'umur' => $request->umur,
            'pendidikan' => $request->pendidikan,
        ]);

        // Sync kategori minat ke pelajar (relasi many-to-many)
        $pelajar->categories()->sync($request->minat);

        return redirect()->route('pelajar.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
