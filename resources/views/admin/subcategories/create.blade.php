@extends('admin.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Tambah Subkategori</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="category_id" class="block font-medium">Kategori</label>
            <select name="category_id" id="category_id" class="w-full border p-2 rounded">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="subcat-container">
            <div class="subcat-item mb-4">
                <label class="block font-medium">Nama Subkategori</label>
                <input type="text" name="names[]" class="w-full border p-2 rounded mb-2" required>
                <label class="block font-medium">Gambar Subkategori (opsional)</label>
                <input type="file" name="images[]" accept="image/*" class="w-full border p-2 rounded">
            </div>
        </div>

        <button type="button" id="add-subcat" class="bg-gray-200 text-sm px-3 py-1 rounded mb-4">+ Tambah Subkategori</button>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">Simpan</button>
        </div>
    </form>
</div>

<script>
document.getElementById('add-subcat').addEventListener('click', function () {
    const container = document.getElementById('subcat-container');
    const div = document.createElement('div');
    div.classList.add('subcat-item', 'mb-4');
    div.innerHTML = `
        <label class="block font-medium">Nama Subkategori</label>
        <input type="text" name="names[]" class="w-full border p-2 rounded mb-2" required>
        <label class="block font-medium">Gambar Subkategori (opsional)</label>
        <input type="file" name="images[]" accept="image/*" class="w-full border p-2 rounded">
    `;
    container.appendChild(div);
});
</script>
@endsection
