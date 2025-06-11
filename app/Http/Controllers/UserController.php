<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan halaman dashboard umum (bisa untuk user biasa).
     * Tidak menjalankan query SQL, hanya mengembalikan view.
     */
    public function dashboard()
    {
        return view('dashboard'); // View tanpa query
    }

    /**
     * Menampilkan semua data user di halaman manager.
     */
    public function index()
    {
        $users = User::all(); // Mengambil semua data dari tabel users
        // SQL: SELECT * FROM users;
        return view('manager.users', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru.
     */
    public function create()
    {
        return view('manager.create_user'); // View tanpa query
    }

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,manager,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Password di-hash
            'role' => $request->role,
        ]);
        // SQL: INSERT INTO users (name, email, password, role, created_at, updated_at)
        //      VALUES ('nama', 'email, 'hashed_password', 'role', now(), now());

        return redirect()->route('manager.users')->with('success', 'User created successfully');
    }

    /**
     * Menampilkan form edit untuk user berdasarkan ID.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id); // Ambil user berdasarkan ID, 404 jika tidak ditemukan
        // SQL: SELECT * FROM users WHERE id = ? LIMIT 1;
        return view('manager.edit_user', compact('user'));
    }

    /**
     * Memperbarui data user berdasarkan ID.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id); // Cari user berdasarkan ID
        // SQL: SELECT * FROM users WHERE id = ? LIMIT 1;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Jika password diisi, hash dan simpan
        }

        $user->save(); // Simpan perubahan ke database
        // SQL: UPDATE users SET name = ?, email = ?, role = ?, password = ?, updated_at = now() WHERE id = ?;

        return redirect()->route('manager.users')->with('success', 'User updated successfully');
    }

    /**
     * Menghapus user dari database berdasarkan ID.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete(); // Cari dan hapus user
        // SQL: DELETE FROM users WHERE id = ?;
        return redirect()->route('manager.users')->with('success', 'User deleted successfully');
    }
}
