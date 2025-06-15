<?php

namespace App\Http\Controllers\Pelajar;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Material; 
use Illuminate\Http\Request;
class KategoriController extends Controller
{
 public function index(Request $request)
{
    $selectedCategoryId = $request->get('category'); // Ambil ID kategori dari query string

    // Ambil semua kategori untuk dropdown
    $allCategories = Category::all();

    // Ambil kategori (filtered atau semua)
    $categoriesQuery = Category::with('subcategories');

    if ($selectedCategoryId) {
        $categoriesQuery->where('id', $selectedCategoryId);
    }

    $categories = $categoriesQuery->get();

    // Tambahkan satu gambar acak dari materi ke setiap kategori
    $categories = $categories->map(function ($category) {
        $subcategoryIds = $category->subcategories->pluck('id');

        $materi = Material::whereIn('subcategory_id', $subcategoryIds)
                          ->inRandomOrder()
                          ->first();

        $category->randomImage = $materi?->image;

        return $category;
    });

    return view('pelajar.materi', compact('categories', 'allCategories', 'selectedCategoryId'));
}
public function show(Request $request, Category $category)
{
    // Ambil semua subkategori milik kategori ini
    $categorySubcategories = $category->subcategories;

    // Ambil ID subkategori terpilih (dari URL)
    $filterId = $request->get('subcategory_id');

    // Ambil subkategori yang difilter
    $subcategories = $category->subcategories()
        ->when($filterId, function ($query, $filterId) {
            return $query->where('id', $filterId);
        })
        ->get();

    return view('pelajar.kategori.show', [
        'category' => $category,
        'subcategories' => $subcategories,
        'categorySubcategories' => $categorySubcategories,
        'filterId' => $filterId
    ]);
}


}
