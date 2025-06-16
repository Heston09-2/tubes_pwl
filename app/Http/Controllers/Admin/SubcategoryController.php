<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    // Menampilkan daftar semua subkategori
    public function index(Request $request)
{
    $categories = Category::all();
    $query = Subcategory::query()->with('category');

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $subcategories = $query->latest()->get();

    return view('admin.subcategories.index', compact('subcategories', 'categories'));
}


    // Form tambah subkategori
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }

    // Simpan subkategori baru
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'names' => 'required|array|min:1',
            'names.*' => 'required|string|max:255|distinct',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $messages = [];

        foreach ($request->names as $index => $name) {
            $exists = Subcategory::where('name', $name)->where('category_id', $request->category_id)->exists();

            if (!$exists) {
                $imagePath = null;

                if ($request->hasFile("images.$index")) {
                    $imagePath = $request->file("images.$index")->store('subcategories', 'public');
                }

                Subcategory::create([
                    'category_id' => $request->category_id,
                    'name' => $name,
                    'image' => $imagePath,
                ]);
            } else {
                $messages[] = "Subkategori '$name' sudah ada dan tidak ditambahkan ulang.";
            }
        }

        $successMessage = 'Subkategori berhasil ditambahkan.';
        if (!empty($messages)) {
            $successMessage .= ' ' . implode(' ', $messages);
        }

        return redirect()->route('admin.subcategories.index')->with('success', $successMessage);
    }

    // Form edit subkategori
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    // Update subkategori
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['category_id', 'name']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($subcategory->image) {
                Storage::disk('public')->delete($subcategory->image);
            }

            $data['image'] = $request->file('image')->store('subcategories', 'public');
        }

        $subcategory->update($data);

        return redirect()->route('admin.subcategories.index')->with('success', 'Subkategori berhasil diperbarui.');
    }

    // Hapus subkategori
    public function destroy(Subcategory $subcategory)
    {
        if ($subcategory->image) {
            Storage::disk('public')->delete($subcategory->image);
        }

        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')->with('success', 'Subkategori berhasil dihapus.');
    }
}
