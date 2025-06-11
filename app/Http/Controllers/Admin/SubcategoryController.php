<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;

class SubcategoryController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'names' => 'required|array|min:1',
            'names.*' => 'required|string|max:255|distinct', // pastikan tidak kosong & tidak duplikat dalam input
        ]);

        $messages = [];

        foreach ($request->names as $name) {
            // Cek apakah sudah ada subkategori dengan nama yang sama
            $exists = Subcategory::where('name', $name)->where('category_id', $request->category_id)->exists();

            if (!$exists) {
                Subcategory::create([
                    'category_id' => $request->category_id,
                    'name' => $name,
                ]);
            } else {
                $messages[] = "Subkategori '$name' sudah ada dan tidak ditambahkan ulang.";
            }
        }

        $successMessage = 'Subkategori berhasil ditambahkan.';
        if (!empty($messages)) {
            $successMessage .= ' ' . implode(' ', $messages);
        }

        return redirect()->route('admin.subcategories.create')->with('success', $successMessage);
    }
}
