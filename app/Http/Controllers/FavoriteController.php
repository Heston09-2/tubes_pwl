<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Artwork;

class FavoriteController extends Controller
{
    // Fungsi untuk menambahkan atau menghapus favorit (toggle)
    public function toggleFavorite($id)
    {
        $user = auth()->user(); // Ambil user yang sedang login
        $artwork = Artwork::findOrFail($id); // Cari karya berdasarkan ID, kalau tidak ketemu maka error 404

        // Cek apakah karya sudah difavoritkan oleh user
        if ($user->favorites()->where('artwork_id', $id)->exists()) {
            // Jika sudah ada di favorit, hapus dari pivot table 'favorites'
            $user->favorites()->detach($id);
            return back()->with('success', 'Dihapus dari favorit.');
        } else {
            // Jika belum ada di favorit, tambahkan ke pivot table 'favorites'
            $user->favorites()->attach($id);
            return back()->with('success', 'Ditambahkan ke favorit.');
        }
    }

    // Fungsi untuk menampilkan semua karya yang sudah difavoritkan oleh user
    public function myFavorites()
    {
        $favorites = auth()->user()->favorites; // Ambil semua karya favorit user dari relasi many-to-many
        return view('favorites.index', compact('favorites')); // Tampilkan ke view favorites/index.blade.php
    }

    // Fungsi untuk menampilkan 10 karya yang paling banyak difavoritkan oleh semua user
    public function mostFavorited()
    {
        $mostFavorited = Artwork::withCount('favoritedBy') // Hitung jumlah user yang memfavoritkan tiap karya
            ->orderByDesc('favorited_by_count') // Urutkan dari yang paling banyak
            ->take(10) // Ambil 10 teratas
            ->get();

        return view('favorites.popular', compact('mostFavorited')); // Tampilkan ke view favorites/popular.blade.php
    }

    // Fungsi untuk menghapus favorit tertentu dari user
    public function removeFavorite($id)
    {
        $user = auth()->user(); // Ambil user yang sedang login
        $user->favorites()->detach($id); // Hapus relasi favorit berdasarkan artwork_id
        return back()->with('success', 'Dihapus dari favorit.');
    }
}
