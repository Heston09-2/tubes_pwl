<?php

namespace App\Http\Controllers\Pelajar;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Material;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Comment;

class MateriController extends Controller


{
public function home()
{
    $pelajar = auth()->guard('pelajar')->user();

    $randomMaterial = Material::inRandomOrder()->whereNotNull('image')->first();

    $popularCategories = Category::withCount('materials')
        ->orderByDesc('materials_count')
        ->take(4)
        ->get();

    $latestMaterials = Material::with('category')->latest()->take(6)->get();

    // Ambil kategori berdasarkan minat pelajar
    $minatCategories = $pelajar->minats()
        ->withCount('materials')
        ->orderByDesc('materials_count')
        ->get();

    return view('pelajar.home', compact(
        'randomMaterial',
        'popularCategories',
        'latestMaterials',
        'minatCategories'
    ));
}



    public function detailMateri(Subcategory $subcategory)
    {
        $materials = $subcategory->materials()->paginate(10);
        return view('pelajar.materi.detail', compact('subcategory', 'materials'));
    }

    public function showMateri($id)
{
    $material = Material::with(['category', 'subcategory'])->findOrFail($id);

    return view('pelajar.materi.show', compact('material'));
}

public function toggleLike($id)
{
    $material = Material::findOrFail($id);

    $pelajar = auth('pelajar')->user();
    $existing = $material->likes()->where('pelajar_id', $pelajar->id)->first();

    if ($existing) {
        $existing->delete(); // Un-like
    } else {
        $material->likes()->create(['pelajar_id' => $pelajar->id]);
    }

    return redirect()->route('pelajar.materi.show', $id)->withFragment('simpan');
}


   public function storeComment(Request $request, $id)
{
    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    Comment::create([
        'pelajar_id' => auth('pelajar')->id(),
        'material_id' => $id,
        'content' => $request->content,
    ]);

    return redirect()->route('pelajar.materi.show', $id)->withFragment('komentar');
}

public function saved()
{
    
    $pelajar = auth('pelajar')->user();
    $savedMaterials = $pelajar->likedMaterials()->latest()->paginate(10);
    return view('pelajar.saved', compact('savedMaterials'));
}







}

