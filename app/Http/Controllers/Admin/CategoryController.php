<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create()
{
    return view('admin.categories.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|array',
        'name.*' => 'required|string|max:255|unique:categories,name',
        'image' => 'nullable|array',
        'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    foreach ($request->name as $index => $name) {
        $imagePath = null;

       
        if ($request->hasFile("image.$index")) {
            $imagePath = $request->file("image.$index")->store('categories', 'public');
        }

        Category::create([
            'name' => $name,
            'image' => $imagePath,
        ]);
    }

    return redirect()->route('admin.materials.index')->with('success', 'Kategori berhasil ditambahkan.');
}

public function index()
{
    $categories = Category::latest()->get();
    return view('admin.categories.index', compact('categories'));
}

public function edit(Category $category)
{
    return view('admin.categories.edit', compact('category'));
}
public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    // Update nama
    $category->name = $request->name;

    // Jika ada gambar baru di-upload
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($category->image && \Storage::exists($category->image)) {
            \Storage::delete($category->image);
        }

        // Simpan gambar baru
        $path = $request->file('image')->store('categories', 'public');
        $category->image = $path;
    }

    $category->save();

    return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
}


public function destroy(Category $category)
{
    if ($category->image && \Storage::disk('public')->exists($category->image)) {
        \Storage::disk('public')->delete($category->image);
    }

    $category->delete();

    return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
}




}

