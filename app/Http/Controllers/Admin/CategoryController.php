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
        'name' => 'required|string|max:255|unique:categories,name',
    ]);

    Category::create([
        'name' => $request->name,
    ]);

    return redirect()->route('admin.categories.create')->with('success', 'Kategori berhasil ditambahkan.');
}



}

