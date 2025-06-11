<?php

namespace App\Http\Controllers\Pelajar;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Material; 
class KategoriController extends Controller
{
    public function index()
    {
        // Ambil semua kategori dengan subkategorinya
        $categories = Category::with('subcategories')->get();

        // Tambahkan satu gambar random dari materi ke setiap kategori
        $categories = $categories->map(function ($category) {
            $subcategoryIds = $category->subcategories->pluck('id');

            // Cari satu materi acak dari subkategori-subkategori tersebut
            $materi = Material::whereIn('subcategory_id', $subcategoryIds)
                              ->inRandomOrder()
                              ->first();

            // Simpan gambar (jika ada) sebagai properti tambahan
            $category->randomImage = $materi?->image;

            return $category;
        });

        return view('pelajar.materi', compact('categories'));
    }

    public function show(Category $category)
    {
        $subcategories = $category->subcategories;
        return view('pelajar.kategori.show', compact('category', 'subcategories'));
    }
}
