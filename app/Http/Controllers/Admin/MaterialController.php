<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with('category', 'subcategory')->latest()->paginate(10);
        return view('admin.materials.index', compact('materials'));
    }

    public function create()
    {
        $categories = Category::with('subcategories')->get();
        return view('admin.materials.create', compact('categories'));
    }

    public function store(Request $request)
{
    $count = count($request->title);

    for ($i = 0; $i < $count; $i++) {
        // Validasi setiap input
        $request->validate([
            'title.' . $i => 'required|string|max:255',
            'content.' . $i => 'required',
            'category_id.' . $i => 'required|exists:categories,id',
            'subcategory_id.' . $i => 'required|exists:subcategories,id',
            'image.' . $i => 'nullable|image|max:2048',
        ]);
        
        $imagePath = null;
        if ($request->hasFile("image.$i")) {
            $imagePath = $request->file("image.$i")->store('materials', 'public');
        }

        Material::create([
            'title' => $request->title[$i],
            'content' => $request->content[$i],
            'category_id' => $request->category_id[$i],
            'subcategory_id' => $request->subcategory_id[$i],
            'image' => $imagePath,
            'admin_id' => Auth::id(),
        ]);
    }

    return redirect()->route('admin.materials.index')->with('success', 'Semua materi berhasil ditambahkan.');
}

    public function edit(Material $material)
{
    $categories = Category::with('subcategories')->get();

    // Ambil subkategori berdasarkan kategori materi saat ini
    $subcategories = Subcategory::where('category_id', $material->category_id)->get();

    return view('admin.materials.edit', compact('material', 'categories', 'subcategories'));
}



    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($material->image) {
                Storage::disk('public')->delete($material->image);
            }
            $validated['image'] = $request->file('image')->store('materials', 'public');
        }

        $material->update($validated);

        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Material $material)
    {
        if ($material->image) {
            Storage::disk('public')->delete($material->image);
        }
        $material->delete();

        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil dihapus.');
    }

    


    
}
