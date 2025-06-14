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
    ]);

    foreach ($request->name as $name) {
        Category::create(['name' => $name]);
    }

    return redirect()->route('admin.materials.index')->with('success', 'Kategori berhasil ditambahkan.');
}


}

