@extends('admin.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Subkategori</h1>

    <form action="{{ route('admin.subcategories.update', $subcategory) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="category_id" class="block font-medium">Kategori</label>
            <select name="category_id" id="category_id" class="w-full border p-2 rounded">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Nama Subkategori</label>
            <input type="text" name="name" value="{{ $subcategory->name }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            @if($subcategory->image)
                <img src="{{ asset('storage/' . $subcategory->image) }}" alt="gambar lama" class="h-32 rounded mb-2">
            @endif
            <label class="block font-medium">Ganti Gambar (opsional)</label>
            <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">Update</button>
    </form>
</div>
@endsection
